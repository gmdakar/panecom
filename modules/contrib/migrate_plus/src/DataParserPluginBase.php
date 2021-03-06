<?php

declare(strict_types = 1);

namespace Drupal\migrate_plus;

use Drupal\Core\Plugin\PluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a base data parser implementation.
 *
 * @see \Drupal\migrate_plus\Annotation\DataParser
 * @see \Drupal\migrate_plus\DataParserPluginInterface
 * @see \Drupal\migrate_plus\DataParserPluginManager
 * @see plugin_api
 */
abstract class DataParserPluginBase extends PluginBase implements DataParserPluginInterface {

  /**
   * List of source urls.
   *
   * @var string[]
   */
  protected ?array $urls;

  /**
   * Index of the currently-open url.
   */
  protected ?int $activeUrl = NULL;

  /**
   * String indicating how to select an item's data from the source.
   *
   * @var string|int
   */
  protected $itemSelector;

  /**
   * Current item when iterating.
   *
   * @var mixed
   */
  protected $currentItem = NULL;

  /**
   * Value of the ID for the current item when iterating.
   */
  protected ?array $currentId = NULL;

  /**
   * The data retrieval client.
   */
  protected DataFetcherPluginInterface $dataFetcher;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->urls = $configuration['urls'];
    $this->itemSelector = $configuration['item_selector'] ?? '';
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new static($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * Returns the initialized data fetcher plugin.
   */
  public function getDataFetcherPlugin(): DataFetcherPluginInterface {
    if (!isset($this->dataFetcher)) {
      $this->dataFetcher = \Drupal::service('plugin.manager.migrate_plus.data_fetcher')->createInstance($this->configuration['data_fetcher_plugin'], $this->configuration);
    }
    return $this->dataFetcher;
  }

  /**
   * {@inheritdoc}
   */
  #[\ReturnTypeWillChange]
  public function rewind() {
    $this->activeUrl = NULL;
    $this->next();
  }

  /**
   * {@inheritdoc}
   */
  #[\ReturnTypeWillChange]
  public function next() {
    $this->currentItem = $this->currentId = NULL;
    if (is_null($this->activeUrl)) {
      if (!$this->nextSource()) {
        // No data to import.
        return;
      }
    }
    // At this point, we have a valid open source url, try to fetch a row from
    // it.
    $this->fetchNextRow();
    // If there was no valid row there, try the next url (if any).
    if (is_null($this->currentItem)) {
      while ($this->nextSource()) {
        $this->fetchNextRow();
        if ($this->valid()) {
          break;
        }
      }
    }
    if ($this->valid()) {
      foreach ($this->configuration['ids'] as $id_field_name => $id_info) {
        $this->currentId[$id_field_name] = $this->currentItem[$id_field_name];
      }
    }
  }

  /**
   * Opens the specified URL.
   *
   * @param string $url
   *   URL to open.
   */
  abstract protected function openSourceUrl(string $url): bool;

  /**
   * Retrieves the next row of data. populating currentItem.
   */
  abstract protected function fetchNextRow(): void;

  /**
   * Advances the data parser to the next source url.
   */
  protected function nextSource(): bool {
    if (empty($this->urls)) {
      return FALSE;
    }

    while ($this->activeUrl === NULL || (count($this->urls) - 1) > $this->activeUrl) {
      if (is_null($this->activeUrl)) {
        $this->activeUrl = 0;
      }
      else {
        // Increment the activeUrl so we try to load the next source.
        ++$this->activeUrl;
        if ($this->activeUrl >= count($this->urls)) {
          return FALSE;
        }
      }

      if ($this->openSourceUrl($this->urls[$this->activeUrl])) {
        // We have a valid source.
        return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  #[\ReturnTypeWillChange]
  public function current() {
    return $this->currentItem;
  }

  /**
   * {@inheritdoc}
   */
  public function currentUrl(): ?string {
    $index = $this->activeUrl ?: \array_key_first($this->urls);

    return $this->urls[$index] ?? NULL;
  }

  /**
   * {@inheritdoc}
   */
  #[\ReturnTypeWillChange]
  public function key() {
    return $this->currentId;
  }

  /**
   * {@inheritdoc}
   */
  #[\ReturnTypeWillChange]
  public function valid() {
    return !empty($this->currentItem);
  }

  /**
   * {@inheritdoc}
   */
  #[\ReturnTypeWillChange]
  public function count() {
    return iterator_count($this);
  }

  /**
   * Return the selectors used to populate each configured field.
   *
   * @return string[]
   *   Array of selectors, keyed by field name.
   */
  protected function fieldSelectors(): array {
    $fields = [];
    foreach ($this->configuration['fields'] as $field_info) {
      if (isset($field_info['selector'])) {
        $fields[$field_info['name']] = $field_info['selector'];
      }
    }
    return $fields;
  }

}
