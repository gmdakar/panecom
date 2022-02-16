<?php

namespace Drupal\notifications_widget\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Url;

/**
 * Provides settings for Notification widget module.
 */
class NotificationsWidgetSettingsForm extends ConfigFormBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

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
   */
  public function __construct(
    ConfigFactoryInterface $config_factory,
    ModuleHandlerInterface $module_handler,
    EntityTypeManagerInterface $entity_manager) {
    parent::__construct($config_factory);
    $this->moduleHandler = $module_handler;
    $this->entityTypeManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('module_handler'),
      $container->get('entity_type.manager')
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
    return 'notifications_widget_settings';
  }

  /**
   * Build form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config        = $this->config('notifications_widget.settings');
    $commentExists = $this->moduleHandler->moduleExists('comment');

    // User entity.
    $form['user_entity_type'] = [
      '#type' => 'fieldset',
      '#title' => 'Users',
    ];
    $form['user_entity_type'] += $this->prepareEntityTypeForm(
      'user',
      'User',
      $config,
      'Entity'
    );

    // Content Type list.
    $nodeTypeStorage = $this->entityTypeManager->getStorage('node_type');
    $nodeTypes       = $nodeTypeStorage->loadMultiple();

    $form['content_type'] = [
      '#type' => 'fieldset',
      '#title' => 'Content Types',
    ];
    foreach ($nodeTypes as $nodeType => $nodeTypeData) {
      $nodeTypeName = $nodeTypeData->get('name');
      $form['content_type'] += $this->prepareEntityTypeForm(
        $nodeType,
        $nodeTypeName,
        $config,
        'Content'
      );
    }

    // Comment Type list.
    if ($commentExists) {
      $commentTypeStorage = $this->entityTypeManager->getStorage('comment_type');
      $commentTypes       = $commentTypeStorage->loadMultiple();

      $form['comment_type'] = [
        '#type' => 'fieldset',
        '#title' => 'Comment Types',
      ];
      foreach ($commentTypes as $commentType => $commentTypeData) {
        $commentTypeName = str_replace('Default', '', $commentTypeData->get('label'));
        $form['comment_type'] += $this->prepareEntityTypeForm(
          $commentType,
          $commentTypeName,
          $config,
          'Comment'
        );
      }
    }

    // Vocabulary list.
    $termStorage = $this->entityTypeManager->getStorage('taxonomy_vocabulary');
    $termTypes   = $termStorage->loadMultiple();

    $form['term_type'] = [
      '#type' => 'fieldset',
      '#title' => 'Taxonomy Types',
    ];
    foreach ($termTypes as $termType => $termTypeData) {
      $termTypeName = $termTypeData->get('name');
      $form['term_type'] += $this->prepareEntityTypeForm(
        $termType,
        $termTypeName,
        $config,
        'Taxonomy'
      );
    }

    /*
     * Allow notification for additional entity types.
     */
    if (!empty($config->get('additional_entity_type'))) {
      $form['additional_entity_type'] = [
        '#type' => 'fieldset',
        '#title' => 'Additional Entity types',
      ];

      $flag = 0;

      $addtionalEntityTypes = explode(',', $config->get('additional_entity_type'));

      foreach ($addtionalEntityTypes as $entityType) {
        if ($this->entityTypeManager->hasDefinition($entityType)) {
          $entityTypeStorage     = $this->entityTypeManager->getStorage($entityType);
          $additionalEntityTypes = $entityTypeStorage->loadMultiple();

          if (!empty($additionalEntityTypes)) {
            $form['additional_entity_type'][$entityType] = [
              '#type' => 'fieldset',
              '#title' => ucwords(str_replace('_', ' ', $entityType)),
            ];

            foreach ($additionalEntityTypes as $additionalEntityType => $additionalEntityTypesData) {
              $entityTypeName = str_replace('Default', '', $additionalEntityTypesData->get('label'));
              $flag = 1;
              $form['additional_entity_type'][$entityType] += $this->prepareEntityTypeForm(
                $additionalEntityType,
                $entityTypeName,
                $config,
                ucwords(strtok($entityType, "_"))
              );
            }
          }
        }
      }
      if ($flag == 1) {
        $form['additional_entity_type']['#description'] =
          $this->t(
            'List of additional entity types added from <a href="@link">Notifications Admin Settings</a>',
            [
              '@link' => Url::fromRoute('notifications_widget.notifications_widget_logger_settings')->toString(),
            ]
          );
      }
      else {
        $form['additional_entity_type']['#description'] =
          $this->t(
            'There no additional entity types added into admin settings. You can add more entity type from <a href="@link">Notifications Admin Settings</a>',
            [
              '@link' => Url::fromRoute('notifications_widget.notifications_widget_logger_settings')->toString(),
            ]
          );
      }
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function prepareEntityTypeForm($nodeType, $nodeTypeName, $config, $entityName) {
    $form = [];
    $form[$nodeType] = [
      '#type'  => 'details',
      '#title' => $this->t('@entityName Type - @nodeTypeName',
        [
          '@entityName'   => $entityName,
          '@nodeTypeName' => $nodeTypeName,
        ]
      ),
      '#open'  => FALSE,
    ];

    $contentDefaultUrl    = '[entity:url]';
    $contentTypeEnable    = $nodeType . '_enable';
    $contentCreateDefault = $nodeType . '_noti_create_message';
    $contentUpdateDefault = $nodeType . '_noti_update_message';
    $contentDeleteDefault = $nodeType . '_noti_delete_message';

    $contentDefaultSettngs     = $config->get($contentTypeEnable);
    $contentCreateDefaultValue = $config->get($contentCreateDefault);
    $contentUpdateDefaultValue = $config->get($contentUpdateDefault);
    $contentDeleteDefaultValue = $config->get($contentDeleteDefault);
    $contentConfStatus         = $config->get('notfication_widget_conf');

    /*
     * Configure & set default values.
     */
    if (empty($contentDefaultSettngs) && $contentConfStatus != 1) {
      $contentDefaultValues = ['Create', 'Update', 'Delete'];
    }
    else {
      $contentDefaultValues = explode(',', $contentDefaultSettngs);
    }

    if (empty($contentCreateDefaultValue)) {
      $contentCreateDefaultValue = $this->t(
        '@nodeTypeName has been created by [user:name]',
        ['@nodeTypeName' => $nodeTypeName]);
    }

    if (empty($contentUpdateDefaultValue)) {
      $contentUpdateDefaultValue = $this->t(
        '@nodeTypeName has been updated by [user:name]',
        ['@nodeTypeName' => $nodeTypeName]);
    }

    if (empty($contentDeleteDefaultValue)) {
      $contentDeleteDefaultValue = $this->t(
        '@nodeTypeName has been deleted by [user:name]',
        ['@nodeTypeName' => $nodeTypeName]);
    }

    $form[$nodeType][$contentTypeEnable] = [
      '#type'          => 'checkboxes',
      '#options'       => [
        'Create' => 'Create',
        'Update' => 'Update',
        'Delete' => 'Delete',
      ],
      '#title'         => 'Notification logs enable',
      '#default_value' => $contentDefaultValues,
    ];
    $form[$nodeType][$nodeType . '_noti_create_message'] = [
      '#type'          => 'textfield',
      '#title'         => 'Create Notification Message',
      '#default_value' => $contentCreateDefaultValue,
    ];
    $form[$nodeType][$nodeType . '_redirect_create_link'] = [
      '#type'          => 'textfield',
      '#title'         => 'Create Notification Message URL',
      '#description'   => $this->t('The url, path for this notification to link. Leave blank if no link is required.'),
      '#default_value' => is_null($config->get($nodeType . '_redirect_create_link')) ? $contentDefaultUrl : $config->get($nodeType . '_redirect_create_link'),
    ];
    $form[$nodeType][$nodeType . '_noti_update_message'] = [
      '#type'          => 'textfield',
      '#title'         => 'Update Notification Message',
      '#default_value' => $contentUpdateDefaultValue,
    ];
    $form[$nodeType][$nodeType . '_redirect_update_link'] = [
      '#type'          => 'textfield',
      '#title'         => 'Update Notification Message URL',
      '#description'   => $this->t('The url, path for this notification to link. Leave blank if no link is required.'),
      '#default_value' => is_null($config->get($nodeType . '_redirect_update_link')) ? $contentDefaultUrl : $config->get($nodeType . '_redirect_update_link'),
    ];
    $form[$nodeType][$nodeType . '_noti_delete_message'] = [
      '#type'          => 'textfield',
      '#title'         => 'Delete Notification Message',
      '#default_value' => $contentDeleteDefaultValue,
    ];
    $form[$nodeType][$nodeType . '_redirect_delete_link'] = [
      '#type'          => 'textfield',
      '#title'         => 'Delete Notification Message URL',
      '#description'   => $this->t('The url, path for this notification to link. Leave blank if no link is required.'),
      '#default_value' => is_null($config->get($nodeType . '_redirect_delete_link')) ? $contentDefaultUrl : $config->get($nodeType . '_redirect_delete_link'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $values        = $form_state->getValues();
    $commentExists = $this->moduleHandler->moduleExists('comment');

    // Store users settings.
    $this->storeEntityNotificationsSettings(['user' => 'user'], $values);

    // Store content type settings.
    $nodeTypeStorage = $this->entityTypeManager->getStorage('node_type');
    $nodeTypes       = $nodeTypeStorage->loadMultiple();
    $this->storeEntityNotificationsSettings($nodeTypes, $values);

    // Store comment type settings.
    if ($commentExists) {
      $commentTypeStorage = $this->entityTypeManager->getStorage('comment_type');
      $commentTypes       = $commentTypeStorage->loadMultiple();
      $this->storeEntityNotificationsSettings($commentTypes, $values);

      $addtionalEntityTypes = explode(',',
        $this->config('notifications_widget.settings')
            ->get('additional_entity_type')
        );
    }

    // Store taxonomy type settings.
    $termStorage = $this->entityTypeManager->getStorage('taxonomy_vocabulary');
    $termTypes   = $termStorage->loadMultiple();
    $this->storeEntityNotificationsSettings($termTypes, $values);

    // Store additional entity type.
    foreach ($addtionalEntityTypes as $entityType) {
      if ($this->entityTypeManager->hasDefinition($entityType)) {

        $entityTypeStorage     = $this->entityTypeManager->getStorage($entityType);
        $additionalEntityTypes = $entityTypeStorage->loadMultiple();

        if (!empty($additionalEntityTypes)) {
          $this->storeEntityNotificationsSettings($additionalEntityTypes, $values);
        }
      }
    }

    $this->config('notifications_widget.settings')
      ->set('notfication_widget_conf', 1)
      ->save();
  }

  /**
   * Store entity notification settings.
   */
  public function storeEntityNotificationsSettings($entity, $values) {

    foreach ($entity as $entityType => $entityTypeData) {
      $enableSettings = $entityType . '_enable';
      $enableCreate   = $entityType . '_noti_create_message';
      $enableUpdate   = $entityType . '_noti_update_message';
      $enableDelete   = $entityType . '_noti_delete_message';
      $createLink     = $entityType . '_redirect_create_link';
      $updateLink     = $entityType . '_redirect_update_link';
      $deleteLink     = $entityType . '_redirect_delete_link';

      $this->config('notifications_widget.settings')
        ->set($enableSettings, implode(',', array_filter($values[$enableSettings])))
        ->set($enableCreate, $values[$enableCreate])
        ->set($enableUpdate, $values[$enableUpdate])
        ->set($enableDelete, $values[$enableDelete])
        ->set($createLink, $values[$createLink])
        ->set($updateLink, $values[$updateLink])
        ->set($deleteLink, $values[$deleteLink])
        ->save();
    }
  }

}
