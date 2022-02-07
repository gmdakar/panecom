/**
 * @file
 * Global utilities.
 *
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.panecom_bstrp = {
    attach: function (context, settings) {
		
		/*cacher le block notifications si on clique sur clear all de la liste des notifs*/
		$('.clear-all-notification').click(function() {
		  console.log("click on clear-all-notification");
		  $("#block-notificationwidgetblock").hide();
		});
		
		/*cacher le block notifications si on a 0 notif*/
		$('.noti-store-msg').click(function() {
		  console.log("click on one notification:", $("#notificationcount").attr('data-count'));
		  if ($("#notificationcount").attr('data-count') == '1') /*it means it was the last currently visible*/
			  $(this).closest("#block-notificationwidgetblock").hide();
		});
    }
  };

})(jQuery, Drupal);
