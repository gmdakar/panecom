(function ($, Drupal, drupalSettings, CKEDITOR){
  'use strict';

  const dataAttributes = [
    'data-start-val',
    'data-end',
    'data-duration',
    'data-decimal-places',
    'data-use-easing',
    'data-smart-easing-threshold',
    'data-smart-easing-amount',
    'data-use-grouping',
    'data-separator',
    'data-decimal',
    'data-prefix',
    'data-suffix'
  ];

  CKEDITOR.plugins.add('countup',{
    icons: 'icon',
    hidpi: false,

    beforeInit: function (editor) {
      editor.widgets.add('countup', {
        allowedContent: 'span[class,' + dataAttributes.join(',') + ']',
        requiredContent: 'span[class,data-end]',
        pathName: Drupal.t('CountUp'),

        upcast: function (element) {
          if (element.attributes['data-end'] === undefined) {
            return;
          }
          return element;
        },

        downcast: function (element) {
          return element;
        }
      });

      editor.widgets.on('instanceCreated', function(event) {
        var widget = event.data;

        if (widget.name === 'countup') {
          widget.on('edit', function(event) {
            event.cancel();
            editor.execCommand('countup');
          });
        }
      });
    },

    init: function init(editor) {
      editor.addCommand('countup', {
        allowedContent: 'span[class,' + dataAttributes.join(',') + ']',
        modes: { wysiwyg: 1 },
        canUndo: true,
        exec: function exec(editor) {
          var existingValues = {},
            selectedElement = editor.getSelection().getSelectedElement(),
            existingElement;

          if (selectedElement && selectedElement.getFirst()) {
            var widget = editor.widgets.getByElement(selectedElement, true);
            if (widget && widget.name === 'countup') {
              existingElement = selectedElement.getFirst();
              existingValues = existingElement.$.dataset;
            }
          }

          var dialogSettings = {
            title: editor.config.CountUp_dialogTitleAdd,
            dialogClass: 'countup-count-dialog'
          };

          if (existingValues) {
            dialogSettings.title = editor.config.CountUp_dialogTitleEdit;
          }

          var saveCallback = function saveCallback(returnValues) {
            editor.fire('saveSnapshot');

            var element = existingElement || new CKEDITOR.dom.element('span', editor.document);

            element.addClass('countup');

            // Reset previous values.
            if (existingElement) {
              element.setHtml('');

              for (var i =0; i < dataAttributes.length; i++) {
                if (element.hasAttribute(dataAttributes[i])) {
                  element.removeAttribute(dataAttributes[i]);
                }
              }
            }

            element.setAttributes(returnValues.attributes);

            if (returnValues.attributes['data-prefix'] !== undefined) {
              element.appendHtml(returnValues.attributes['data-prefix']);
            }

            element.appendHtml(returnValues.attributes['data-end']);

            if (returnValues.attributes['data-suffix'] !== undefined) {
              element.appendHtml(returnValues.attributes['data-suffix']);
            }

            if (!existingElement) {
              editor.insertHtml(element.getOuterHtml());
            }

            editor.fire('saveSnapshot');
          };
          Drupal.ckeditor.openDialog(editor, Drupal.url('countup/dialog/count/' + editor.config.drupal.format), existingValues, saveCallback, dialogSettings);
        }
      });
      if (editor.ui.addButton){
        editor.ui.addButton('countup',{
          label: Drupal.t('Count'),
          command: 'countup',
          icon: this.path +'/icons/icon.png'
        });
      }
    }
  });

  /**
   * Stores the dialog title for "add" operation.
   *
   *		// This is actually the default value.
   *		config.CountUp_dialogTitleEdit = 'Add';
   *
   * @member CKEDITOR.config
   */
  CKEDITOR.config.CountUp_dialogTitleAdd = 'Add';

  /**
   * Stores the dialog title for "edit" operation.
   *
   *		// This is actually the default value.
   *		config.CountUp_dialogTitleEdit = 'Edit';
   *
   * @member CKEDITOR.config
   */
  CKEDITOR.config.CountUp_dialogTitleEdit = 'Edit';


})(window.jQuery, window.Drupal, window.drupalSettings, window.CKEDITOR);
