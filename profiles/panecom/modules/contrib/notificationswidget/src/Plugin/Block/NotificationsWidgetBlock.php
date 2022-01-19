<?php

namespace Drupal\notifications_widget\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a block with list of notification items.
 *
 * @Block(
 *   id = "notification_widget_block",
 *   admin_label = @Translation("Notification widget block"),
 *   category = @Translation("Notifications widget")
 * )
 */
class NotificationsWidgetBlock extends BlockBase implements ContainerFactoryPluginInterface, BlockPluginInterface {

  /**
   * Drupal\Core\Session\AccountInterface definition.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * The Database Connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration,
    $plugin_id,
    $plugin_definition,
    AccountInterface $current_user,
    Connection $database) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentUser = $current_user;
    $this->database    = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    // Retrieve existing configuration for this block.
    $config = $this->getConfiguration();

    // Add a form field to the existing block configuration form.
    $form['block_notification_type'] = [
      '#type'    => 'select',
      '#title'   => $this->t('Notification Content'),
      '#options' => ['As Admin', 'As Logged-In user'],
      '#default_value' => isset($config['block_notification_type']) ? $config['block_notification_type'] : '',
    ];

    $form['block_notification_logs_display'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Skip Display to own activities'),
      '#default_value' => TRUE,
      '#states'        => [
        'visible'      => [
          ':input[name="settings[block_notification_type]"]' => ['value' => '1'],
        ],
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('block_notification_type', $form_state->getValue('block_notification_type'));
    $this->setConfigurationValue('block_notification_logs_display', $form_state->getValue('block_notification_logs_display'));
  }

  /**
   * {@inheritdoc}
   */
  public function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIf($account->isAuthenticated());
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $connection = $this->database;
    $config     = $this->getConfiguration();

    // Get logged user session.
    $currentUser = $this->currentUser;

    $uid = $currentUser->id();
    $notificationType = 0;
    $totalCount = 0;
    $unreadCount = 0;
    $notificationList = [];

    $query = $connection->select('notifications', 'n');
    $query->fields('n', [
      'id',
      'message',
      'status',
    ]);

    if (isset($config['block_notification_type'])
     && $config['block_notification_type'] == 1
     && $config['block_notification_logs_display'] == 1) {
      $query->condition('n.entity_uid', $uid);
      $query->condition('n.uid', $uid, '<>');
      $notificationType = 1;
    }
    elseif (isset($config['block_notification_type'])
     && $config['block_notification_type'] == 1
     && $config['block_notification_logs_display'] == 0) {
      $query->condition('n.entity_uid', $uid);
      $notificationType = 1;
    }

    $query->orderBy('n.created', 'DESC');
    $res = $query->execute();

    while ($notification = $res->fetchObject()) {

      if (!empty($notification->message)) {
        $notificationList[] = [
          'id'      => $notification->id,
          'message' => $notification->message,
          'status'  => $notification->status,
        ];

        if ($notification->status == 0) {
          $unreadCount++;
        }

        $totalCount++;
      }
    }

    return [
      '#theme' => 'notifications_widget',
      '#uid' => $uid,
      '#notification_type' => $notificationType,
      '#total' => $totalCount,
      '#unread' => $unreadCount,
      '#notification_list' => $notificationList,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
