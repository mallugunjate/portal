CKEDITOR.dialog.add( 'documentlinkDialog', function( editor ) {
    return {
        title: 'Add Document Links',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'tab-basic',
                label: 'Add Document Link',
                elements: [
                    {
                        type: 'text',
                        id: 'documentlink_documentname',
                        label: 'Document Name',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Document Name field cannot be empty." )
                    },
                    {
                        type: 'text',
                        id: 'documentlink_documentid',
                        label: 'Document Id',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Document Id field cannot be empty." )
                    },
                    {
                        type: 'text',
                        id: 'documentlink_documentfolderpath',
                        label: 'Parent Folder Path',
                        // validate: CKEDITOR.dialog.validate.notEmpty( "parent Folder cannot be empty." )
                    }

                ]
            },
            
        ],
        onOk: function() {
            var dialog = this;

            var link = editor.document.createElement( 'a' );
            link.setAttribute( 'href',  "/"+localStorage.getItem('userStoreNumber')+'/document#!/'+dialog.getValueOf( 'tab-basic', 'documentlink_documentpath' ) );
            link.setText( dialog.getValueOf( 'tab-basic', 'folderlink_documentname' ) );
            editor.insertElement( link );
            editor.insertElement( link );
        },
        onShow: function() {
            var dialog = this;
            
            var name = localStorage.getItem('documentName');
            var id = localStorage.getItem('documentId');
            var path = localStorage.getItem('documentFolderPath');
            var documentId = dialog.getContentElement('tab-basic', 'documentlink_documentid');
            var documentName = dialog.getContentElement('tab-basic', 'documentlink_documentname');
            var documentFolderPath = dialog.getContentElement('tab-basic', 'documentlink_documentfolderpath');
            documentId.setValue(id);
            documentName.setValue(name);
            documentFolderPath.setValue(path);
            this.getContentElement('tab-basic','documentlink_documentid').getElement().hide();
            this.getContentElement('tab-basic','documentlink_documentfolderpath').disable();

            
        }
    };
});