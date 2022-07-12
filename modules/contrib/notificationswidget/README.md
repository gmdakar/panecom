INTRODUCTION
------------

Notification Module allows you to configure the site notification on bell with
feature of :
* Read
* Unread
* Delete
* Clear all

It allows to customize the notification message with token replacement like :
[user:name], [node:title], [comment:entity:title] etc.
It provides a block which contains notifications based on settings.

It provides the feature to extend the logs for additional provided entities like
profile_type, paragraphs and more.

IMPORTANT NOTES :
1. Widget configuration must be saved once module installed.
2. Bootstrap theme or CSS should be included into your project.


INSTALLATION
------------

Install, and activate the module as you would any other module. As soon as the
module is active, then notifications widget settings must be saved to logs the
data.

If you wish to exclude certain entities from being log, then you can put
the entity name into provide configuration and their logs will not be tracked.

If you wish add additional entity to being logs, then update the notifications
admin settings to provide the valid entity types (comma seperated)


CONFIGURATION
-------------

* Configure the user permissions in Administration » People » Permissions:

 - Access POST on Update notifications items resource

   The top-level administration categories require this permission to be
   accessible to view the notifications.

* Customize the Notifications settings in Administration » Configuration »
   system » Notifications Widget settings.

* Configure the notification widget block in Administration » Structure »
  Block Layout
   - Notification widget block

* Service provided to add any new notification message using below sample code :

```php
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
```

Example usage:
```php
  $notificationService = \Drupal::service('notifications_widget.logger');
  $message = [
    'id' => '1234',
    'bundle' => 'article',
    'content' => 'Lorem ipsum read data by [user:name]',
    'content_link' => 'users-list',
  ];

  $notificationService->logNotification($message, 'create', $entity);
```


MAINTAINERS
-----------

Current maintainers:
 * Vernit Gupta - https://www.drupal.org/u/vernit
 * BramDriesen - https://www.drupal.org/u/bramdriesen


REQUIREMENTS
-------------

* Core system with bootstrap css must be installed.
* Once module installed then widget configuration must be saved.
