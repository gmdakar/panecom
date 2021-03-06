<?php

declare(strict_types = 1);

namespace Drupal\migrate_plus\Plugin\migrate_plus\data_fetcher;

use GuzzleHttp\Client;
use Drupal\migrate_plus\AuthenticationPluginInterface;
use Psr\Http\Message\ResponseInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\migrate\MigrateException;
use Drupal\migrate_plus\DataFetcherPluginBase;
use GuzzleHttp\Exception\RequestException;

/**
 * Retrieve data over an HTTP connection for migration.
 *
 * Example:
 *
 * @code
 * source:
 *   plugin: url
 *   data_fetcher_plugin: http
 *   headers:
 *     Accept: application/json
 *     User-Agent: Internet Explorer 6
 *     Authorization-Key: secret
 *     Arbitrary-Header: foobarbaz
 * @endcode
 *
 * @DataFetcher(
 *   id = "http",
 *   title = @Translation("HTTP")
 * )
 */
class Http extends DataFetcherPluginBase implements ContainerFactoryPluginInterface {

  /**
   * The HTTP client.
   */
  protected ?Client $httpClient;

  /**
   * The request headers.
   */
  protected array $headers = [];

  /**
   * The data retrieval client.
   */
  protected AuthenticationPluginInterface $authenticationPlugin;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->httpClient = \Drupal::httpClient();

    // Ensure there is a 'headers' key in the configuration.
    $configuration += ['headers' => []];
    $this->setRequestHeaders($configuration['headers']);
  }

  /**
   * Returns the initialized authentication plugin.
   *
   *   The authentication plugin.
   */
  public function getAuthenticationPlugin(): AuthenticationPluginInterface {
    if (!isset($this->authenticationPlugin)) {
      $this->authenticationPlugin = \Drupal::service('plugin.manager.migrate_plus.authentication')->createInstance($this->configuration['authentication']['plugin'], $this->configuration['authentication']);
    }
    return $this->authenticationPlugin;
  }

  /**
   * {@inheritdoc}
   */
  public function setRequestHeaders(array $headers): void {
    $this->headers = $headers;
  }

  /**
   * {@inheritdoc}
   */
  public function getRequestHeaders(): array {
    return !empty($this->headers) ? $this->headers : [];
  }

  /**
   * {@inheritdoc}
   */
  public function getResponse($url): ResponseInterface {
    try {
      $options = ['headers' => $this->getRequestHeaders()];
      if (!empty($this->configuration['authentication'])) {
        $options = array_merge($options, $this->getAuthenticationPlugin()->getAuthenticationOptions());
      }
      if (!empty($this->configuration['request_options'])) {
        $options = array_merge($options, $this->configuration['request_options']);
      }
      $response = $this->httpClient->get($url, $options);
      if (empty($response)) {
        throw new MigrateException('No response at ' . $url . '.');
      }
    }
    catch (RequestException $e) {
      throw new MigrateException('Error message: ' . $e->getMessage() . ' at ' . $url . '.');
    }
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function getResponseContent(string $url): string {
    return (string) $this->getResponse($url)->getBody();
  }

}
