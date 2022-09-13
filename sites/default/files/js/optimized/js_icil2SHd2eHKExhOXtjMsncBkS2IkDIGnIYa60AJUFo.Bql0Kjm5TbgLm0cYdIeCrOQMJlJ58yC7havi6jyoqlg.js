/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/modules/contrib/animate_any/js/form.js. */
/**
 * @file
 * Apply js for animation admin form to show demostation of animation type
 */
(function ($, Drupal) {
    'use strict';
    Drupal.behaviors.animate = {
        attach: function (context, settings) {
            var root = $('table.animation tr');
            // apply each for every row
            root.each(function (i, element) {
                var el = $(element); // current element
                // on slect list change
                el.find('.select_animate').change(function () {
                    // remove exsisting class and apply new one
                    el.find('#animate').removeClass().addClass('animated ' + this.value);
                });
            });
        }
    };
})(jQuery, Drupal);

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/modules/contrib/animate_any/js/form.js. */