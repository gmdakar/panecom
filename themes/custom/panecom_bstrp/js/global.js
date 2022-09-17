/**
 * @file
 * Global utilities.
 *
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.panecom_bstrp_notificationwidget = {
    attach: function (context, settings) {
		
		/*hack pour eviter un effet gallery popup lors de la selection d'un média depuis le media browser*/
		$( ".js-media-library-add-form .photoswipe-galery a.photoswipe" ).each(function() {
		  $( this ).removeClass('photoswipe');
		  $( this ).removeClass('photoswipe-gallery--fallback-wrapper');
		});		
		$( ".js-media-library-views-form .photoswipe-gallery a.photoswipe" ).each(function() {
		  $( this ).removeClass('photoswipe');
		  $( this ).removeClass('photoswipe-gallery--fallback-wrapper');
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
		  $("#notificationcount").attr('data-count', $("#notificationcount").attr('data-count') - 1);
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
			
			$('#block-menuorganisationmembre.block li:first-child a').addClass("is-active");
			$('#block-menuorganisationmembre.block li a').click(function() {
			  $("#block-menuorganisationmembre.block li a").removeClass("is-active");
			});
			
			$(".page-user-register main").prepend("<p><a class='backlink' href='#' onclick='history.go(-1);'></a></p>");
			
        }
  };
  
    Drupal.behaviors.panecom_bstrp_actualites_quoi2_9 = {
        attach: function (context, settings) {
			
			/*setTimeout(function() { 
				var owl = $('.owl-carousel');
				owl.owlCarousel(); 
			
				owl.on('changed.owl.carousel', function(e) {
				    
					var obj_prev_actu = $('.block-views-blockles--block-2 .owl-stage > div.active').prev();
					var obj_next_actu = $('.block-views-blockles--block-2 .owl-stage > div.active').next();	
					var prev_actu_small_img = obj_prev_actu.find(".views-field-field-image-1 .small-img img").attr("src");
					var next_actu_small_img = obj_next_actu.find(".views-field-field-image-1 .small-img img").attr("src");
					$(".block-views-blockles--block-2 .owl-stage > div.active").append("<style>.block-views-blockles--block-2 .owl-stage > div.active::before{background-image:url('"+prev_actu_small_img+"') !important; visibility: initial;");
					$(".block-views-blockles--block-2 .owl-stage > div.active").append("<style>.block-views-blockles--block-2 .owl-stage > div.active::after{background-image:url('"+next_actu_small_img+"') !important; visibility: initial;");
								
					console.log("prev_actu:" + prev_actu_small_img + " - current_actu:" + current_actu + " - next_actu:" + next_actu_small_img);
					
				 })
			   
			}, 500);*/
				
			/*$('.block-views-blockles--block-2 .view-content.row').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				autoplay: true,
			  });*/
			  
			if ($('#block-views-block-les-block-2 .view-content.row').length)
				slick_carousel($('#block-views-block-les-block-2 .view-content.row'));
			
			if( $('#actualites .view-content.row').length)
				slick_carousel($('#actualites .view-content.row'));
			
			
        }
  };

})(jQuery, Drupal);

function slick_carousel(obj){
	
	obj.slick({
			  centerMode: true,
			  centerPadding: '15.6%',
			  slidesToShow: 1,
			  autoplay: false,
			  dots: true,
				prevArrow: '<button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>',
				nextArrow: '<button type="button" role="presentation" class="owl-next disabled"><span aria-label="Next">›</span></button>',
					   
			  infinite: true,
			  speed: 300,
			  responsive: [
				{
				  breakpoint: 768,
				  settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 1
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 1
				  }
				}
			  ]
			});
}
