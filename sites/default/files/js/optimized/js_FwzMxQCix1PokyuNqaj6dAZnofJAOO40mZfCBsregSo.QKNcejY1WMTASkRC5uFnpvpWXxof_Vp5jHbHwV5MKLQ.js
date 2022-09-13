/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/themes/contrib/bootstrap_barrio/js/modules/views/ajax_view.js. */
/**
 * @file
 * Extends core ajax_view.js.
 */

(function ($, Drupal) {
  'use strict';

  /**
   * @method
   */
  Drupal.views.ajaxView.prototype.attachExposedFormAjax = function () {
    var that = this;
    this.exposedFormAjax = [];
    $('button[type=submit], input[type=submit], input[type=image]', this.$exposed_form).not('[data-drupal-selector=edit-reset]').each(function (index) {
      var self_settings = $.extend({}, that.element_settings, {
        base: $(this).attr('id'),
        element: this
      });
      that.exposedFormAjax[index] = Drupal.ajax(self_settings);
    });
  };

})(jQuery, Drupal);

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/themes/contrib/bootstrap_barrio/js/modules/views/ajax_view.js. */