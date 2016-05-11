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
                    // {
                    //     type : 'button',
                    //     id : 'folderlink_browse',
                    //     label : 'Browse Folders',                        
                    // },
                    {
                        type: 'text',
                        id: 'folderlink_foldername',
                        label: 'Folder Name',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Folder name cannot be empty." )
                    },
                    {
                        type: 'text',
                        id: 'folderlink_folderid',
                        label: 'Folder Id',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Folder Id cannot be empty." ),
                        class: 'hidden'
                        
                    },
                    // {
                    //     type: 'text',
                    //     id: 'folderlink_folderpath',
                    //     label: 'Folder Path',
                    //     validate: CKEDITOR.dialog.validate.notEmpty( "Folder Path cannot be empty." ),
                        
                    // },
                    
                ]
            },
            
        ],
        onOk: function() {
            var dialog = this;

            var link = editor.document.createElement( 'a' );
            link.setAttribute( 'href',  "/"+localStorage.getItem('userStoreNumber')+'/document#!/'+dialog.getValueOf( 'tab-basic', 'folderlink_folderid' ) );
            link.setText( dialog.getValueOf( 'tab-basic', 'folderlink_foldername' ) );
            editor.insertElement( link );
        },
        onLoad: function() {
            var dialog = this;
            
                var id = localStorage.getItem('folderId');
                var name = localStorage.getItem('folderName');
                var folderId = dialog.getContentElement('tab-basic', 'folderlink_folderid');
                var folderName = dialog.getContentElement('tab-basic', 'folderlink_foldername');
                // var folderPath = dialog.getContentElement('tab-basic', 'folderlink_folderpath');
                folderId.setValue(id);
                folderName.setValue(name);
                // folderPath.setValue(copiedText);
            
        }
        
        
    };
});