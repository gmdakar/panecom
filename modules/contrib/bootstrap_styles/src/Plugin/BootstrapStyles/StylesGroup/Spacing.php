<?php

namespace Drupal\bootstrap_styles\Plugin\BootstrapStyles\StylesGroup;

use Drupal\bootstrap_styles\StylesGroup\StylesGroupPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\bootstrap_styles\ResponsiveTrait;

/**
 * Class Spacing.
 *
 * @package Drupal\bootstrap_styles\Plugin\StylesGroup
 *
 * @StylesGroup(
 *   id = "spacing",
 *   title = @Translation("Spacing"),
 *   weight = 3,
 *   icon = "bootstrap_styles/images/plugins/spacing-icon.svg"
 * )
 */
class Spacing extends StylesGroupPluginBase {
  use ResponsiveTrait;

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['spacing'] = [
      '#type' => 'details',
      '#title' => $this->t('Spacing'),
      '#open' => FALSE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function buildStyleFormElements(array &$form, FormStateInterface $form_state, $storage) {
    $this->buildBreakpointsFields($form, 'spacing');

    $form['spacing_preview'] = [
      '#theme' => 'spacing_preview',
    ];

    return $form;
  }

}
