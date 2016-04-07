$("#delete-folder").on('click', function(e){
	
	e.preventDefault();
		var folderid = $(this).attr('data-folderId');
		var folderName = $("#folderNameForDeleteModal").val();
		var allDocumentsInFolderCount = $("#allDocumentsInFolderCount").val();
		var allChildFolders = $("#allChildFolderCount").val();
		var text = 'This folder contains '+allChildFolders+' subfolders and '+allDocumentsInFolderCount+' total documents. \n';
		//var title = 'Are you sure you want to delete <span style="font-style:italic;">'+folderName+'</span>';
		// if (allDocumentsInFolderCount>0) {
		// 	text += allDocumentsInFolderCount + ' Documents \n';
		// } 
		// if (allChildFolders>0) {
		// 	text +=  ' ' + allChildFolders + ' Folders';
		// }


		swal({
	        title: 'Really delete <em>'+folderName+'</em>?',
	        text: text,
	        type: "warning",
	        html: true,
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, delete this folder",
	        closeOnConfirm: false
	    }, function () {
			$.ajax({
				method : "DELETE",
				url : "/admin/folder/" + folderid,
				data : { 
					"_token" : $('[name="_token"]').val(),
					"banner_id" : $('[name="banner_id"]').val(),
				},
				success: function(result) {
		        //swal("Deleted!", "This folder has been deleted.", "success");
		    }
			}).done(function( data ){
				console.log(data);
				
				swal({   
					title: "Deleted!",   
					text: "This folder has been deleted",   
					type: "success"
				}, function(isConfirm){   
					if (isConfirm) {     
						window.location = '/admin/document/manager';
					}  
				});				

			});
		});
});
