<?php

namespace Drupal\countup\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\editor\Ajax\EditorDialogSave;
use Drupal\Core\Ajax\CloseModalDialogCommand;

class CountUpEditorDialogForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(){
    return 'countup_editor_dialog';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Editor $editor = NULL) {
    $input = $form_state->getUserInput();
    $default = [];

    if (isset($input['editor_object'])) {
      foreach ($input['editor_object'] as $key => $value) {
        $key = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
        $default[$key] = $value;
      }
    }

    $form['#attached']['library'][] = 'editor/drupal.editor.dialog';

    $form['attributes'] = [
      '#type' => 'container',
      '#tree' => TRUE,
      '#attributes' => [
        'class' => ['countup-attributes'],
      ],
    ];

    $form['attributes']['start_val'] = [
      '#title' => $this->t('Start number'),
      '#type' => 'number',
      '#default_value' => $default['start_val'] ?? 0,
      '#size' => 6,
      '#step' => 'any',
    ];

    $form['attributes']['end'] = [
      '#title' => $this->t('End number'),
      '#type' => 'number',
      '#default_value' => $default['end'] ?? '',
      '#step' => 'any',
      '#required' => TRUE,
    ];

    $form['attributes']['decimal_places'] = [
      '#title' => $this->t('Number of decimals places'),
      '#type' => 'number',
      '#default_value' => $default['decimal_places'] ?? 0,
      '#min' => 0,
      '#step' => 1,
    ];

    $form['attributes']['decimal'] = [
      '#title' => $this->t('Decimal symbol'),
      '#type' => 'textfield',
      '#default_value' => $default['decimal'] ?? '.',
      '#size' => 2,
      '#states' => [
        'disabled' => [
          ':input[name="attributes[decimal_places]"]' => ['value' => '0'],
        ],
      ],
    ];

    $form['attributes']['duration'] = [
      '#title' => $this->t('Duration of animation'),
      '#type' => 'number',
      '#default_value' => $default['duration'] ?? 1,
      '#field_suffix' => 'seconds',
      '#min' => 0,
      '#step' => .1,
    ];

    $form['attributes']['use_easing'] = [
      '#title' => $this->t('Use easing'),
      '#type' => 'checkbox',
      '#default_value' => !empty($default['use_easing']),
    ];

    $form['attributes']['smart_easing_threshold'] = [
      '#title' => $this->t('Smart easing threshold'),
      '#type' => 'textfield',
      '#default_value' => $default['smart_easing_threshold'] ?? '',
      '#size' => 4,
      '#description' => $this->t('Smooth easing for large numbers above this if useEasing (999)'),
      '#states' => [
        'disabled' => [
          ':input[name="attributes[use_easing]"]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['attributes']['smart_easing_amount'] = [
      '#title' => $this->t('smart easing amount'),
      '#type' => 'textfield',
      '#default_value' => $default['smart_easing_amount'] ?? '',
      '#size' => 4,
      '#description' => $this->t('Amount to be eased for numbers above threshold (333)'),
      '#states' => [
        'disabled' => [
          ':input[name="attributes[use_easing]"]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['attributes']['use_grouping'] = [
      '#title' => $this->t('Group the element'),
      '#type' => 'checkbox',
      '#default_value' => !empty($default['use_grouping']),
      '#description' => $this->t('example: 1,000 vs 1000 (true)'),
    ];

    $form['attributes']['separator'] = [
      '#title' => $this->t('Thousand separator'),
      '#type' => 'textfield',
      '#default_value' => $default['separator'] ?? ',',
      '#size' => 2,
      '#states' => [
        'disabled' => [
          ':input[name="attributes[use_grouping]"]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['attributes']['prefix'] = [
      '#title' => $this->t('Prefix'),
      '#type' => 'textfield',
      '#default_value' => $default['prefix'] ?? '',
      '#size' => 10,
    ];

    $form['attributes']['suffix'] = [
      '#title' => $this->t('Suffix'),
      '#type' => 'textfield',
      '#default_value' => $default['suffix'] ?? '',
      '#size' => 10,
    ];

    // @todo make the countu class configurable? This is currently fixed to
    //   ".countup"; but maybe this could lead to collision with other libraries?

    $form['action'] = ['#type' => 'actions'];
    $form['action']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Insert Animation'),
      '#submit' => [],
      '#ajax' => [
        'callback' => '::submitForm',
        'event' => 'click',
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $attributes = [];

    foreach ($form_state->getValue('attributes', []) as $key => $value) {
      if (strlen($value)) {
        $attributes['data-' . strtr($key, '_', '-')] = $value;
      }
    }

    $response = new AjaxResponse();
    $response->addCommand(new EditorDialogSave(['attributes' => $attributes]));
    $response->addCommand(new CloseModalDialogCommand());

    return $response;
  }
}
