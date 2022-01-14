<?php

namespace Drupal\notifications_widget\Services;

use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountProxy;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\Core\Utility\Token;
use Drupal\Component\Datetime\TimeInterface;

/**
 * Service handler for Notification Logger.
 */
class NotificationsWidgetService {

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;

  /**
   * Symfony\Component\HttpFoundation\Request definition.
   *
   * @var Symfony\Component\HttpFoundation\Request
   */
  protected $request;

  /**
   * Drupal\Core\Database\Connection definition.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * The config factory object.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Logger Factory.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactory
   */
  protected $loggerFactory;

  /**
   * Drupal\Core\Utility\Token definition.
   *
   * @var \Drupal\Core\Utility\Token
   */
  protected $token;

  /**
   * The time service.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $time;

  /**
   * {@inheritdoc}
   */
  public function __construct(AccountProxy $current_user,
  Connection $database,
  RequestStack $request,
  ConfigFactoryInterface $config_factory,
  LoggerChannelFactory $loggerFactory,
  Token $token,
  TimeInterface $time) {
    $this->currentUser   = $current_user;
    $this->database      = $database;
    $this->request       = $request;
    $this->configFactory = $config_factory;
    $this->loggerFactory = $loggerFactory->get('activity_tracking');
    $this->token         = $token;
    $this->time          = $time;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user'),
      $container->get('database'),
      $container->get('request_stack'),
      $container->get('config.factory'),
      $container->get('token'),
      $container->get('datetime.time')
    );
  }

  /**
   * Stores the data into notification table.
   */
  public function logNotification($message, $userAction, $entity) {
    // Get logged user session.
    $currentUser = $this->currentUser;
    if ($entity->bundle() == 'user') {
      $entityUid = $entity->id();
    }
    elseif (method_exists($entity, 'getOwner')) {
      $entityUid = $entity->getOwner()->id();
    }
    else {
      $entityUid = 1;
    }

    // Fetch the excluded entities to notifications.
    $notificationConfig = $this->configFactory->get('notifications_widget.settings');
    $excludeList        = $notificationConfig->get('excluded_entities');
    $excludeBundles     = explode(',', $excludeList);

    if ($message['content_link'] == '[entity:url]') {
      $entityUrl = $entity->toUrl()->toString();
    }
    else {
      $entityUrl = $message['content_link'];
    }

    // Valildate for bundle exclusion.
    if (!in_array($entity->bundle(), $excludeBundles)) {

      // Prepare notification item link.
      $messageItems = '<a class="noti-store-msg" href="javascript:;" data-link="' . $entityUrl . '">' . $message['content'] . '</a>';

      $messageItems = $this->token->replace(
        $messageItems, [
          'user'    => $this->currentUser,
          'node'    => $entity,
          'comment' => $entity,
        ]
      );

      $keys = [
        'id' => NULL,
      ];

      $fields = [
        'entity_id'  => $message['id'],
        'entity_uid' => $entityUid,
        'action'     => $userAction,
        'bundle'     => $message['bundle'],
        'uid'        => $currentUser->id(),
        'user_name'  => $currentUser->getDisplayName(),
        'message'    => $messageItems,
        'status'     => 0,
        'created'    => $this->time->getRequestTime(),
      ];

      try {
        $this->database->merge('notifications')
          ->key($keys)
          ->fields($fields)
          ->execute();
      }
      catch (Exception $e) {
        // Exception handling if something else gets thrown.
        $this->loggerFactory->error($e->getMessage());
      }

    }

  }

}
