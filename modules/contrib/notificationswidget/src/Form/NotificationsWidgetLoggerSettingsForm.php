<?php

namespace Drupal\notifications_widget\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Url;

/**
 * Provides settings for Activity tracking module.
 */
class NotificationsWidgetLoggerSettingsForm extends ConfigFormBase {
  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The messager type manager.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messengerTypeManager;

  /**
   * The module manager service.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Constructs an AutologoutSettingsForm object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module manager service.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_manager
   *   The module entity manager service.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger_manager
   *   The module messager manager service.
   */
  public function __construct(
        ConfigFactoryInterface $config_factory,
        ModuleHandlerInterface $module_handler,
        EntityTypeManagerInterface $entity_manager,
        MessengerInterface $messenger_manager
    ) {
    parent::__construct($config_factory);
    $this->moduleHandler = $module_handler;
    $this->entityTypeManager = $entity_manager;
    $this->messengerTypeManager = $messenger_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
          $container->get('config.factory'),
          $container->get('module_handler'),
          $container->get('entity_type.manager'),
          $container->get('messenger')
      );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['notifications_widget.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'notifications_widget_admin_settings';
  }

  /**
   * Build form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('notifications_widget.settings');
    $form['excluded_entities'] = [
      '#type'          => 'textarea',
      '#title'         => $this->t('Exclude Entities (comma seperated)'),
      '#description'   => $this->t('Exclude the notification entities for excluding'),
      '#default_value' => $config->get('excluded_entities'),
    ];
    $form['additional_entity_type'] = [
      '#type'          => 'textarea',
      '#title'         => $this->t('Additional Entity Types (comma seperated)'),
      '#description'   => $this->t('Provide the Entity Types to enable and configure notifications'),
      '#default_value' => $config->get('additional_entity_type'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $haystack = ['user', 'node_type', 'comment_type', 'taxonomy_vocabulary'];

    $values = $form_state->getValues();
    $entities = explode(',', $values['additional_entity_type']);
    if (count(array_intersect($haystack, $entities)) > 0) {
      $form_state->setErrorByName(
            'additional_entity_type',
            $this->t('Default entity type already exists.')
        );
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $values = $form_state->getValues();
    $savedEntities = explode(
          ',', $this->config('notifications_widget.settings')
            ->get('additional_entity_type')
      );
    $revisedEntities = explode(',', $values['additional_entity_type']);

    // Prepare removed entity types and remove its configuration.
    $deletedEntities = array_diff($savedEntities, $revisedEntities);
    $this->removeEntityNotificationsSettings($deletedEntities, $values);

    $this->config('notifications_widget.settings')
      ->set('excluded_entities', $values['excluded_entities'])
      ->set('additional_entity_type', $values['additional_entity_type'])
      ->save();
    $this->messengerTypeManager->addMessage(
          $this->t(
              'Notification widget will work well once you saved the configuration from <a href=":user_settings_url">Notification Widget Settings</a>.', [
                ':user_settings_url' => Url::fromRoute('notifications_widget.notifications_widget_settings')->toString(),
              ]
          ), 'warning'
      );
  }

  /**
   * Remove addtional configuration for entity types.
   */
  public function removeEntityNotificationsSettings($entities, $values) {

    foreach ($entities as $entityType) {
      if ($this->entityTypeManager->hasDefinition($entityType)) {
        $entityTypeStorage = $this->entityTypeManager->getStorage($entityType);
        $entityTypes       = $entityTypeStorage->loadMultiple();

        if (!empty($entityTypes)) {
          foreach ($entityTypes as $entityType => $entityTypeData) {
            $enableSettings = $entityType . '_enable';
            $enableCreate   = $entityType . '_noti_create_message';
            $enableUpdate   = $entityType . '_noti_update_message';
            $enableDelete   = $entityType . '_noti_delete_message';
            $createLink     = $entityType . '_redirect_create_link';
            $updateLink     = $entityType . '_redirect_update_link';
            $deleteLink     = $entityType . '_redirect_delete_link';

            $this->config('notifications_widget.settings')
              ->clear($enableSettings)
              ->clear($enableCreate)
              ->clear($enableUpdate)
              ->clear($enableDelete)
              ->clear($createLink)
              ->clear($updateLink)
              ->clear($deleteLink)
              ->save();
          }
        }
      }
    }

  }

}
