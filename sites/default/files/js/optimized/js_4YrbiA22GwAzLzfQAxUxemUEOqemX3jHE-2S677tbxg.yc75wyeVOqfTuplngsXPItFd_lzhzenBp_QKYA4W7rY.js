/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/modules/contrib/lb_tabs/layouts/tabs/tabs.js. */
(function ($, Drupal, drupalSettings){
  Drupal.behaviors.lb_tabs = {
    attach: function (context, settings) {
      for (var id in settings.lb_tabs_tabs) {
        var options = settings.lb_tabs_tabs[id];
        $("#" + id, context).tabs(options);
      }
    }
  };
})(jQuery, Drupal, drupalSettings);

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/modules/contrib/lb_tabs/layouts/tabs/tabs.js. */