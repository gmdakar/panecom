<?php

namespace Drupal\feeds_tamper_convert_encoding\Plugin\Tamper;

use Drupal\Core\Form\FormStateInterface;
use Drupal\tamper\Exception\TamperException;
use Drupal\tamper\TamperableItemInterface;
use Drupal\tamper\TamperBase;

/**
 * Plugin implementation for convert_encoding.
 *
 * @Tamper(
 *   id = "convert_encoding",
 *   label = @Translation("Convert text encoding"),
 *   description = @Translation("Converts string from one encoding to another."),
 *   category = "Text"
 * )
 */
class ConvertEncoding extends TamperBase {

  const DEFAULT_OUTPUT_ENCODING = 'UTF-8';
  const DEFAULT_MODE = '//IGNORE';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $config = parent::defaultConfiguration();
    $config['input_encoding'] = '';
    $config['output_encoding'] = self::DEFAULT_OUTPUT_ENCODING;
    $config['mode'] = self::DEFAULT_MODE;
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $encodings = mb_list_encodings();
    natcasesort($encodings);
    $options = array_combine([''] + $encodings, [$this->t('-- Select encoding --')] + $encodings);
    $form['input_encoding'] = [
      '#type' => 'select',
      '#title' => $this->t('Input encoding'),
      '#required' => TRUE,
      '#options' => $options,
      '#default_value' => $this->getSetting('input_encoding'),
    ];
    $form['output_encoding'] = [
      '#type' => 'select',
      '#title' => $this->t('Output encoding'),
      '#required' => TRUE,
      '#options' => $options,
      '#default_value' => $this->getSetting('output_encoding'),
    ];
    $options = [
      '' => $this->t('Do nothing (will generate PHP notice)'),
      '//TRANSLIT' => $this->t('Transliterate unknown characters'),
      '//IGNORE' => $this->t('Ignore unknown characters'),
    ];
    $form['mode'] = [
      '#type' => 'select',
      '#title' => $this->t('Mode'),
      '#description' => $this->t("How to handle characters that can't be represented in the target encoding."),
      '#required' => TRUE,
      '#options' => $options,
      '#default_value' => $this->getSetting('mode'),
    ];

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->setConfiguration([
      'input_encoding' => $form_state->getValue('input_encoding'),
      'output_encoding' => $form_state->getValue('output_encoding'),
      'mode' => $form_state->getValue('mode'),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function tamper($data, TamperableItemInterface $item = NULL) {
    if (!is_string($data)) {
      throw new TamperException('Input should be a string.');
    }
    $input_encoding = $this->getSetting('input_encoding');
    $output_encoding = $this->getSetting('output_encoding');
    $mode = $this->getSetting('mode');
    $data = iconv($input_encoding, $output_encoding . $mode, $data);
    return $data;
  }

}
