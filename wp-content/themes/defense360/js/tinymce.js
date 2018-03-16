(function() {
  tinymce.PluginManager.add('defense360', function( editor, url ) {
   editor.addButton('highlightedContent', {
    text: 'Highlighted Content',
    tooltip: 'Insert Highlighted Content',
    onclick: function() {
      editor.windowManager.open( {
        title: 'Insert Highlighted Content',
        width: 400,
        height: 150,
        body: [
        {
          type: 'textbox',
          multiline: true,
          name: 'content',
          label: 'Highlighted Content',
          placeholder: 'Insert Highlighted Content'
        }
        ],
        onsubmit: function( e ) {
          editor.insertContent( '[highlightedContent]' + e.data.content + '[/highlightedContent]');
        }
      });
    }
  });

   editor.addButton('fullWidth', {
    text: 'FullWidth',
    tooltip: 'Insert Full Width',
    onclick: function() {
      editor.windowManager.open( {
        title: 'Insert Full Width',
        width: 400,
        height: 150,
        body: [
        {
          type: 'textbox',
          multiline: false,
          name: 'maxWidth',
          label: 'Max Width',
          placeholder: 'Insert Max Width'
        },
        {
          type: 'textbox',
          multiline: true,
          name: 'content',
          label: 'Content',
          placeholder: 'Insert Full Width Content'
        }
        ],
        onsubmit: function( e ) {
          editor.insertContent( '[fullWidth width="' + e.data.maxWidth + '"]' + e.data.content + '[/fullWidth]');
        }
      });
    }
  });

  editor.addButton('interactive', {
         text: 'Interactive',
         tooltip: 'Insert Interactive Shortcode',
         onclick: function() {
          editor.windowManager.open( {
             title: 'Insert Full Width',
             width: 400,
             height: 100,
             body: [
             {
                 type: 'textbox',
                 multiline: false,
                 name: 'id',
                 label: 'Interactive ID',
                 placeholder: 'Insert Interactive ID'
             },
             {
                 type: 'listbox',
                 name: 'align',
                 label: 'Alignment',
                 'values': [
                 {text: 'None', value: null },
                 {text: 'Left', value: 'left' },
                 {text: 'Right', value: 'right' }
                 ]
             },
             ],
             onsubmit: function( e ) {
                 var align = '';
                 if ( e.data.align ) {
                     align = ' align="' + e.data.align + '"';
                 }
                 editor.insertContent( '[data id="' + e.data.id + '"' + align + ']');
             }
         })
      }
  });

 });
})();
