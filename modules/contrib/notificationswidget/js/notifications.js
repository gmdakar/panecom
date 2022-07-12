/**
 * @file
 * JavaScript for notification status update.
 */

(function ($, Drupal, drupalSettings) {
    'use strict';

    /**
     * Attaches the batch behavior for notification.
     *
     * @type {Drupal~behavior}
     */
    Drupal.behaviors.notifications = {
        attach: function (context, settings) {
            var revisedSentance = '';

            /**
             * Notification status changed to UNREAD => READ.
             */
            $('.notification-msg').once().click(
                function (event) {
                    event.stopPropagation();
                    var ele = $(this);
                    var notificationCount = parseInt($('.notification-icon').attr('data-count'));
                    var noticationId = $(this).parent().attr('data-id');
                    var nasId = $(this).parent().attr('data-nas-id');
                    var redirectLocation = $(this).children().attr('data-link');

                    var notiData = {'notiId': noticationId, 'nasId':nasId, 'notification_action': 'read'};

                    getCsrfToken(
                        function (csrfToken) {
                            updateNotification(csrfToken, notiData, redirectLocation);
                            itemsStatusChanged(ele, notificationCount, 'read');
                        }
                    );
                    return false;
                }
            );

            /**
             * Views Notification redirection.
             */
            $('.noti-store-msg').once().click(
                function (event) {
                    if ($(this).parent().attr('class') != 'notification-msg') {
                        event.stopPropagation();
                        var redirectLocation = $(this).attr('data-link');

                        if (redirectLocation === '/') {
                            // Do nothing.
                        }
                        else if (redirectLocation === '') {
                            //location.reload();
                        }
                        else {
                            window.location.href = redirectLocation;
                        }
                        return false;
                    }
                }
            );

            /**
             * Notification delete list.
             */
            $('.notification-remove').once().click(
                function (event) {
                    event.stopPropagation();
                    var ele = $(this);
                    var nasId = $(this).parent().attr('data-nas-id');
                    var noticationId = ele.parent().attr('data-id');
                    var notificationCount = parseInt($('.notification-icon').attr('data-count'));
                    var notiData = {'notiId': noticationId, 'nasId':nasId, 'notification_action': 'delete'};
                    // Request send to delete from list.
                    getCsrfToken(
                        function (csrfToken) {
                            updateNotification(csrfToken, notiData, '/');
                            // Remove notificaiton item from frontend block.
                            itemsStatusChanged(ele, notificationCount, 'delete');
                        }
                    );
                }
            );

            /**
             * Clear-all the notification list
             */
            $('.clear-all-notification').once().click(
                function () {
                    var ele = $(this);
                    var notiId = ele.attr('data-notification-id');
                    var notiUid = ele.attr('data-uid');
                    var notiData = {
                        'notification_action': 'clearall',
                        'notiId': notiId,
                        'uid': notiUid,
                    };

                    // Request send to clear all from list.
                    getCsrfToken(
                        function (csrfToken) {
                            updateNotification(csrfToken, notiData, '/');
                            itemsStatusChanged(ele, 0, 'clearall');
                        }
                    );
                }
            );

            /**
             * Update the notification items status.
             */
            function itemsStatusChanged(ele, notificationCount, action)
            {
                var remainingCount = notificationCount - 1;

                if (remainingCount <= 0) {
                    revisedSentance = 'You have no unread notifications';
                    $('.fyi-notification').html(revisedSentance);
                    $('#notificationcount').removeClass('notification-icon');
                    $('.clear-all-notification').remove();
                }
                else {
                    revisedSentance = 'You have ' + remainingCount;
                    if (remainingCount <= 1) {
                        revisedSentance += ' unread notifications';
                    }
                    else {
                        revisedSentance += ' unread notifications';
                    }
                    $('.fyi-notification').html(revisedSentance);
                    $('#notificationcount').attr('data-count', remainingCount);
                }
                switch (action) {
                case 'delete':
                    ele.parent().slideUp().hide(
                        'slide', {
                            direction: 'right'
                        }, 1000
                    );
                    break;

                case 'clearall':
                    $('.drop-content').html('');
                    $('.notify-drop-title').html('You have no unread notifications');
                    ele.remove();
                    break;

                case 'read':
                    ele.parent('li').removeClass('unread');
                    ele.parent('li').removeClass('read');
                    ele.parent('li').attr('data-read-status', 'read');
                    break;
                }
            }

            /**
             * Fetch CSRF token to make POST request.
             */
            function getCsrfToken(callback)
            {
                $.get(Drupal.url('session/token'))
                .done(
                    function (data) {
                        var csrfToken = data;
                        callback(csrfToken);
                    }
                );
            }

            /**
             * Send request to update notification status.
             */
            function updateNotification(csrfToken, notiData, redirectLocation)
            {
                $.ajax(
                    {
                        url: Drupal.url('api/notification_update?_format=json'),
                        type: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken
                        },
                        data: JSON.stringify(notiData),
                        dataType: 'json',
                        success: function (response) {
                            if (redirectLocation === '/') {
                                // Do nothing.
                            }
                            else if (redirectLocation === '') {
                                //location.reload();
                            }
                            else {
                                window.location.href = redirectLocation;
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                        }
                    }
                );
            }
        }
    };
})(jQuery, Drupal, drupalSettings);
