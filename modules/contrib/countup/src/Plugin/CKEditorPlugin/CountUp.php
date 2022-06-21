<?php


namespace Drupal\countup\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "countup" plugin.
 *
 * @CKEditorPlugin(
 *   id = "countup",
 *   label = @Translation("CountUp"),
 *   module = "countup"
 * )
 */
Class CountUp extends CKEditorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      'countup' => [
        'label' => $this->t('CountUp'),
        'image' => drupal_get_path('module', 'countup') . '/js/plugins/countup/icons/icon.png',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor){
    return [
      'CountUp_dialogTitleAdd' => $this->t('Insert a count animation'),
      'CountUp_dialogTitleEdit' => $this->t('Edit the count animation'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFile(){
    return drupal_get_path('module','countup') . '/js/plugins/countup/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [
      'core/drupal.ajax',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled(Editor $editor){
    // Check if someone installing this module probably wants the help.
    return TRUE;
  }
}
