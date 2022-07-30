<?php

namespace Drupal\opigno_messaging\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\opigno_messaging\Ajax\OpignoScrollToLastMessage;
use Drupal\private_message\Entity\PrivateMessageThreadInterface;
use Drupal\private_message\Form\PrivateMessageForm as PrivateMessageFormBase;

/**
 * Override the default PrivateMessageForm.
 *
 * @package Drupal\opigno_messaging\Form
 */
class PrivateMessageForm extends PrivateMessageFormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, PrivateMessageThreadInterface $privateMessageThread = NULL) {
    $form = parent::buildForm($form, $form_state, $privateMessageThread);
    $form['#attached']['library'][] = 'opigno_messaging/ajax_commands';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function ajaxCallback(array $form, FormStateInterface $formState) {
    $response = parent::ajaxCallback($form, $formState);
    // On submit scroll to the last message.
    $response->addCommand(new OpignoScrollToLastMessage());

    return $response;
  }

}
