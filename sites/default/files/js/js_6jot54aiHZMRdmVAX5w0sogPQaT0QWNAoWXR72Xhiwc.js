/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/modules/contrib/addtoany/js/addtoany.js. */
/* global a2a*/
(function (Drupal) {
  'use strict';

  Drupal.behaviors.addToAny = {
    attach: function (context, settings) {
      // If not the full document (it's probably AJAX), and window.a2a exists
      if (context !== document && window.a2a) {
        a2a.init_all(); // Init all uninitiated AddToAny instances
      }
    }
  };

})(Drupal);

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/modules/contrib/addtoany/js/addtoany.js. */;
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

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/modules/contrib/animate_any/js/form.js. */;
/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/modules/contrib/animate_any/js/animate_any.js. */
/**
 * @file
 * Js apply all animation to pages
 */

(function ($, Drupal) {
  'use strict';
  // Animation goes here
  Drupal.behaviors.animate_any = {
    attach: function (context, settings) {
      // Get all animation json data here
      var animations = $.parseJSON(settings.animate.animation_data);
      $.each(animations, function (i, element) {
        // First main identifier
        var animate_parent = element.parent;
        var animate_ident = $.parseJSON(element.identifier);
        // Second below identifier
        if ($(animate_parent).length !== 0) {
          $.each(animate_ident, function (k, item) {
            var section = $(item.section_identity);
            var jsevent = String(item.section_event);
            if ($(item.section_identity).length !== 0) {
              const item_data = {
                'animate_parent': animate_parent,
                'section_identity': item.section_identity,
                'section_animation': item.section_animation,
              };
              // Add animation to child section only when it is visible on viewport
              if (jsevent === 'scroll') {
                $(window).scroll(function () {
                  if (section.visible()) {
                    $(animate_parent).find(item.section_identity).addClass(item.section_animation + ' animated');
                  }
                });
              }
              else if (jsevent === 'onload') {
                $(document).ready(function () {
                  if (section.visible()) {
                    $(animate_parent).find(item.section_identity).addClass(item.section_animation + ' animated');
                  }
                });
              }
              else {
                $(animate_parent).find(item.section_identity).on(jsevent, function () {
                  $(animate_parent).find(item.section_identity).addClass(item.section_animation + ' animated');
                  // Remove animation class from an element to execute it multiple times when event is triggered.
                  clearClass(item_data);
                });
              }
            }
          });
        }
      });
    }
  };

  /**
   * Remove animation classes from an element.
   */
  function clearClass(item_data) {
    setTimeout(() => {
      $(item_data.animate_parent).find(item_data.section_identity).removeClass(item_data.section_animation + ' animated');
    }, 1000);
  }

  /**
   * Function use to identify the dom element visible or not
   */
  $.fn.visible = function () {

    var win = $(window);
    var viewport = {
      top: win.scrollTop(),
      left: win.scrollLeft()
    };
    viewport.right = viewport.left + win.width() - 100;
    viewport.bottom = viewport.top + win.height() - 100;

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
  };
})(jQuery, Drupal);

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/modules/contrib/animate_any/js/animate_any.js. */;
/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/core/misc/jquery.once.bc.js. */
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, once) {
  var deprecatedMessageSuffix = "is deprecated in Drupal 9.3.0 and will be removed in Drupal 10.0.0. Use the core/once library instead. See https://www.drupal.org/node/3158256";
  var originalJQOnce = $.fn.once;
  var originalJQRemoveOnce = $.fn.removeOnce;

  $.fn.once = function jQueryOnce(id) {
    Drupal.deprecationError({
      message: "jQuery.once() ".concat(deprecatedMessageSuffix)
    });
    return originalJQOnce.apply(this, [id]);
  };

  $.fn.removeOnce = function jQueryRemoveOnce(id) {
    Drupal.deprecationError({
      message: "jQuery.removeOnce() ".concat(deprecatedMessageSuffix)
    });
    return originalJQRemoveOnce.apply(this, [id]);
  };

  var drupalOnce = once;

  function augmentedOnce(id, selector, context) {
    originalJQOnce.apply($(selector, context), [id]);
    return drupalOnce(id, selector, context);
  }

  function remove(id, selector, context) {
    originalJQRemoveOnce.apply($(selector, context), [id]);
    return drupalOnce.remove(id, selector, context);
  }

  window.once = Object.assign(augmentedOnce, drupalOnce, {
    remove: remove
  });
})(jQuery, once);
/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/core/misc/jquery.once.bc.js. */;
/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/themes/contrib/bootstrap_barrio/js/barrio.js. */
/**
 * @file
 * Global utilities.
 *
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.bootstrap_barrio = {
    attach: function (context, settings) {

      var position = $(window).scrollTop();
        $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
          $('body').addClass("scrolled");
        }
        else {
          $('body').removeClass("scrolled");
        }
        var scroll = $(window).scrollTop();
        if (scroll > position) {
          $('body').addClass("scrolldown");
          $('body').removeClass("scrollup");
        } else {
          $('body').addClass("scrollup");
          $('body').removeClass("scrolldown");
        }
        position = scroll;
      });

      $('.dropdown-item a.dropdown-toggle').on("click", function (e) {
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
      });
    }
  };

})(jQuery, Drupal);

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/themes/contrib/bootstrap_barrio/js/barrio.js. */;
