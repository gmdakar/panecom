<?php

namespace Drupal\notifications_widget\Services;

/**
 * Interface class for the NotificationsWidgetService.
 */
interface NotificationsWidgetServiceInterface {

  /**
   * Creates a notification in the database.
   *
   * @param array $message .
   *   An array containing all the message information.
   *   Needs to respect the following format:
   *   $message = [
   *     'id' => '12334',
   *     'bundle' => 'article',
   *     'content' => 'Lorem ipsum read data by [user:name]',
   *     'content_link' => 'users-list',
   *   ];
   *
   * @param string $userAction
   *   The action that led to the creation of the notification.
   *   One of the following: create, update, delete
   * @param object $entity
   *   The entity that led to the notification being triggered.
   *   Used to replace tokens in the message content.
   * @param int|null $uid
   *   (optional): The user id to which the notification should be sent.
   */
  public function logNotification(array $message, string $userAction, object $entity, int $uid = NULL): void;

}