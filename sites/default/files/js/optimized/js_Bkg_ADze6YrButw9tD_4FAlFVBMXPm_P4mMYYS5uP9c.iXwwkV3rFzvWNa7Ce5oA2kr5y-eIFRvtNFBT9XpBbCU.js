/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/modules/contrib/owlcarousel/js/owlcarousel.js. */
/**
 * @file
 */

(function ($) {
  Drupal.behaviors.owl = {
    attach: function (context, settings) {
      $('.owl-slider-wrapper', context).each(function () {
        var $this = $(this);
        var $this_settings = $.parseJSON($this.attr('data-settings'));
        $this.owlCarousel($this_settings);
      });
    }
  };
})(jQuery);

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/modules/contrib/owlcarousel/js/owlcarousel.js. */