/**
 * @file
 * Global utilities.
 *
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.panecom_bstrp_notificationwidget = {
    attach: function (context, settings) {
		
		$( ".noti-store-msg" ).each(function() {
		  $( this ).attr( "href", 'javascript:void(0);' );
		});

		//if notification count=0 hide #block-notificationwidgetblock
		if ( ! ($("#notificationcount").length > 0) || $("#notificationcount").attr('data-count') == 0 )
			$('#block-notificationwidgetblock').hide();
		
		/*cacher le block notifications si on clique sur clear all de la liste des notifs*/
		$('.clear-all-notification').click(function() {
		  console.log("click on clear-all-notification");
		  $("#block-notificationwidgetblock").hide();
		});
		
		/*cacher le block notifications si on a 0 notif*/
		$('.noti-store-msg').click(function(event){
		  
		  console.log("click on one notification:", $("#notificationcount").attr('data-count'));
		  if ($("#notificationcount").attr('data-count') == '1') /*it means it was the last currently visible*/
			  $(this).closest("#block-notificationwidgetblock").hide();
		  $("#notificationcount").attr('data-count') = $("#notificationcount").attr('data-count') - 1;
		  event.preventDefault(); //evitons le chargement de page
		  return false;
		});
    }
  };
  
  Drupal.behaviors.panecom_bstrp_stickyNavbar = {
        attach: function (context, settings) {

            var navbar = $('.header');

            if (navbar.length) {
                var elmHeight = 25;
                $(window).scroll(function() {
                    var scrolltop = $(window).scrollTop();
                    if (scrolltop > elmHeight) {
                        if (!navbar.hasClass('sticky')) {
                            navbar.addClass('sticky');
                        }
                    } else {
                        navbar.removeClass('sticky');
                    }
                });
            }

        }

  };

})(jQuery, Drupal);
