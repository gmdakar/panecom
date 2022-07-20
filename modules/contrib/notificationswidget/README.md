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

* Configure the notifications widget block in Administration » Structure »
  Block Layout
   - Notification widget block

* Service provided to add any new notification message using below sample code :

  $notificationService = \Drupal::service('notifications_widget.logger');
  $message                 = [];
  $message['id']           = '8764';
  $message['bundle']       = 'article';
  $message['content']      = "Lorem lipsum read data by [user:name]";
  $message['content_link'] = 'users-list';

  $notificationService->logNotification($message, 'create', $entity);

  $message(Array) = Should content array of message data as per above example.
  $entity(Object) = Should be drupal entity to replace token if any.
  $action(String) = User action from (create, update, delete).


MAINTAINERS
-----------

Current maintainers:
 * Vernit Gupta - https://www.drupal.org/u/vernit

REQUIREMENTS
-------------

* Core system with bootstrap css must be installed.
* Once module installed then widget configuration must be saved.
