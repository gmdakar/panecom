/*
 * Title: gridSlide.js
 * Author: Dan Purdy
 * Website: www.dpurdy.me
 * Description: A multi direction slider plugin for jQuery.

*/

if (typeof Object.create !== 'function') {
  Object.create = function (obj) {
    'use strict';
    function F() {}
    F.prototype = obj;
    return new F();
  };
}

// self invoking function, passes undefined as undefined to alleviate any problems with it having been muted.
(function ($, window, document) {
  'use strict';
  var grid = {

		// init function to setup our slider and perform certain actions depending on user options
    init: function (options, elem) {

			// set reference to this
      var self = this;
      self.elem = elem;
      self.$elem = $(elem).css({overflow: 'hidden'}); // set reference to the jquery object of elem and make the sliders overflow hidden.

      self.options = $.extend({}, $.fn.gridSlide.options, options); // extend plugin options with user set values

      self.$navigation = $(this.options.nav);
      self.list = self.$elem.find('ul'); // find the ul elements within the selected element
			// setting up default arrays
      self.imgs = [];
      self.imgWidth = [];
      self.imgHeight = [];
      self.imgsLen = [];
      self.current = [0, 0];

			// populate img, imgwidth, imgHeight and imgLength arrays to store all the information of each image
      for (var i = 0; i < self.list.length; i++) {
        self.imgs[i] = $(self.list[i]).find('img');
        self.imgWidth[i] = self.imgs[i][0].width;
        self.imgHeight[i] = self.imgs[i][0].height;
        self.imgsLen[i] = self.imgs[i].length;
        $(self.list[i]).width(self.imgWidth[i] * self.imgsLen[i]);
      }

      if (self.options.menu === 'grid') {
        self.buildGridNav(self.options.imgGrid);
      }
      else if (self.options.menu === 'nav') {
        self.buildNav();
      }
      self.attachHandlers(); // attach the event handlers
    },

    buildGridNav: function (imgGrid) {
      this.gridText = '<div class="grid"><div class="grid-nav">';
      for (var i = 0; i < this.list.length; i++) {
        if (this.options.title) {
          this.gridText += '<h3>' + $(this.list[i]).data('title') + '</h3>';
        }
        this.gridText += '<ul class="grid-nav-layer">';
        for (var j = 0; j < this.imgs[i].length; j++) {
          if (i === 0 && j === 0) {
            this.gridText += '<li class="grid-nav-icon grid-active" data-x="' + j + '" data-y="' + i + '" >';
            if (imgGrid) {
              this.gridText += '<img src="' + $(this.imgs[i][j]).attr('src') + '" alt="' + $(this.imgs[i][j]).attr('alt') + '" >';
            }
            this.gridText += '</li>';
          }
          else {
            this.gridText += '<li class="grid-nav-icon" data-x="' + j + '" data-y="' + i + '" >';
            if (imgGrid) {
              this.gridText += '<img src="' + $(this.imgs[i][j]).attr('src') + '" alt="' + $(this.imgs[i][j]).attr('alt') + '" >';
            }
            this.gridText += '</li>';
          }
        }
        this.gridText += '</ul>';
      }
      this.gridText += '</div></div>';
      this.$navigation.show().prepend(this.gridText);
      this.$activeGridEl = $('.grid-active');
    },

    buildNav: function () {
      this.navText = '<div class="nav-buttons"><a class="horizontal prev" data-dir="prev">Prev</a>';
      this.navText += '<a class="vertical up" data-dir="up">Up</a><a class="vertical down" data-dir="down">Down</a>';
      this.navText += '<a class="horizontal next" data-dir="next">Next</a></div>';
      this.$navigation.show().append(this.navText);
    },

		// Function to attach the event handlers
    attachHandlers: function () {
      var self = this;
			// click handler for the grid nav
      if (self.options.menu === 'grid') {
        $('.grid-nav-icon').on('click', function () {
          self.transition($(this).data('x'), $(this).data('y'));
          self.$activeGridEl.removeClass('grid-active'); // update the active grid element.
          self.$activeGridEl = $(this).addClass('grid-active'); // update the active grid element.
        });
      }
      else {
				// click handler for the nav buttons
        $('.nav-buttons').find('a').on('click', function () {
          self.setCurrent($(this).data('dir'));
          self.transition();
        });
      }
    },
		// Function to set the current image when using the nav button navigation
    setCurrent: function (dir) {

			// if direction is next or previous
      if (dir === 'next' || dir === 'prev') {
        var pos = this.current[0];
        pos += (~~(dir === 'next') || -1);
        this.current[0] = (pos < 0) ? this.imgsLen[this.current[1]] - 1 : pos % this.imgsLen[this.current[1]];
      }
      else {
        var level = this.current[1];
        level += (~~(dir === 'down') || -1);
        this.current[1] = (level < 0) ? this.list.length - 1 : level % this.list.length;
        if (this.current[0] > this.imgsLen[this.current[1]] - 1) {
          this.current[0] = this.imgsLen[this.current[1]] - 1;
        }
      }
    },

    transition: function (x, y) {
      var self = this;
      if (x >= 0 && y >= 0) {
        self.current[0] = x;
        self.current[1] = y;
      }
      self.list.stop().animate({
        'margin-left': -(self.current[0] * self.imgWidth[self.current[1]]),
        'top': -(self.current[1] * self.imgHeight[self.current[1]])
      }, this.options.speed);
    }
  };

  $.fn.gridSlide = function (options) {
    return this.each(function () {
      var gridObj = Object.create(grid);
      gridObj.init(options, this);
    });
  };

  $.fn.gridSlide.options = {
    nav: '#slider-nav',
    menu: 'grid',
    title: false,
    imgGrid: false,
    speed: 300
  };

})(jQuery, window, document);
