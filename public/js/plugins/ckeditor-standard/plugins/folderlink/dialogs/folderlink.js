CKEDITOR.dialog.add( 'folderlinkDialog', function( editor ) {
    return {
        title: 'Add Folder Links',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'tab-basic',
                label: 'Add Folder Link',
                elements: [
                    {
                        type: 'text',
                        id: 'link',
                        label: 'Abbreviation',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Abbreviation field cannot be empty." )
                    },
                    {
                        type: 'text',
                        id: 'title',
                        label: 'Explanation',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Explanation field cannot be empty." )
                    }
                ]
            },
            
        ],
        onOk: function() {
            var dialog = this;

            var link = editor.document.createElement( 'a' );
            link.setAttribute( 'title', dialog.getValueOf( 'tab-basic', 'title' ) );
            link.setText( dialog.getValueOf( 'tab-basic', 'link' ) );

            
            editor.insertElement( link );
        }
    };
});