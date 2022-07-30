<?php

namespace Drupal\notifications_widget\Plugin\rest\resource;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Database\Connection;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get update the status of notification items.
 *
 * @RestResource(
 *   id = "notifications_update_widget",
 *   label = @Translation("Update notifications items"),
 *   uri_paths = {
 *     "create" = "/api/notification_update"
 *   }
 * )
 */
class NotificationWidgetUpdateResource extends ResourceBase {

  /**
   * The Database Connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a Drupal\rest\Plugin\ResourceBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   * @param \Drupal\Core\Database\Connection $database
   *   Database Connection.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user,
    Connection $database) {

    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->currentUser = $current_user;
    $this->database    = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('notification-update'),
      $container->get('current_user'),
      $container->get('database'),
      $container->get('request_stack')->getCurrentRequest()
    );
  }

  /**
   * {@inheritdoc}
   */
  public function post(Request $request) {
    $result = [];

    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

	$notificationData = Json::decode($request->getContent());
    $action = $notificationData['notification_action'];
    $id     = (isset($notificationData['notiId'])) ? $notificationData['notiId'] : '';

    switch ($action) {

      case 'read':
        $keys = [
          'id' => $id,
        ];

        $fields = [
          'status'     => 1,
        ];

        try {
          $this->database->merge('notifications')
            ->key($keys)
            ->fields($fields)
            ->execute();
          $result = ['status' => $this->t('successfully read')];
        }
        catch (Exception $e) {
          // Exception handling if something else gets thrown.
          $this->loggerFactory->error($e->getMessage());
        }
        break;

      case 'delete':
        try {
          $this->database->delete('notifications')
            ->condition('id', $id)
            ->execute();
          $result = ['status' => $this->t('successfully Deleted')];
        }
        catch (Exception $e) {
          // Exception handling if something else gets thrown.
          $this->loggerFactory->error($e->getMessage());
        }
        break;

      case 'clearall':
        $notiType = $notificationData['notification_type'];
        $notiUid  = $notificationData['uid'];
        if ($notiType == 1) {
          try {
            $this->database->delete('notifications')
              ->condition('entity_uid', $notiUid)
              ->execute();
            $result = ['status' => $this->t('successfully cleared')];
          }
          catch (Exception $e) {
            // Exception handling if something else gets thrown.
            $this->loggerFactory->error($e->getMessage());
          }
        }
        else {
          try {
            $this->database->delete('notifications')
              ->execute();
            $result = ['status' => $this->t('successfully cleared')];
          }
          catch (Exception $e) {
            // Exception handling if something else gets thrown.
            $this->loggerFactory->error($e->getMessage());
          }
        }
        break;
    }

    $response = new ResourceResponse($result);
    $response->addCacheableDependency($result);
    return $response;
  }

}
