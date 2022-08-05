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
  
  Drupal.behaviors.panecom_bstrp_stickyMenuOrg = {
        attach: function (context, settings) {

            var navbar = $('#block-menuorganisationmembre ul');

            if (navbar.length) {
                var elmHeight = 500;
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
  
  
  
  Drupal.behaviors.panecom_bstrp_jumpto = {
        attach: function (context, settings) {

            /*Scroll transition to anchor*/
			$("a.toscroll").on('click',function(e) {
				var url = e.target.href;
				var hash = url.substring(url.indexOf("#")+1);
				if ($('#'+hash).length) {
					$('html, body').animate({
						scrollTop: $('#'+hash).offset().top - 80
					}, 1750);
				}
				return false;
			});

        }

  };
  
  Drupal.behaviors.panecom_bstrp_misc = {
        attach: function (context, settings) {
			
			$("button.navbar-toggler").removeClass("navbar-togagler"); //for small screen remove this class in order to display correctly hamburger icon
			
			var langCode = drupalSettings.path.currentLanguage;
			$("."+langCode+".nav-link").addClass("is-active"); //force active lang (hack js car pas d'explication sur le bug)
			
            /*onload page: make focus to first element sidebar menu organisation membre */
			$(".sidebar #block-menuorganisationmembre.block li:first-child a").addClass( "focused");
			
			$(".sidebar #block-menuorganisationmembre.block li a").on('click',function(e) {
				$(".sidebar #block-menuorganisationmembre.block li a").removeClass( "focused" );
				$(this).addClass( "focused" );
			});
			
			/*order columns counters*/
			$( ".highlight.organisation_membre" ).closest(".column").addClass("order-1");
			$( ".highlight.projet" ).closest(".column").addClass("order-2");
			$( ".highlight.document" ).closest(".column").addClass("order-3");
			
        }
  };

})(jQuery, Drupal);
