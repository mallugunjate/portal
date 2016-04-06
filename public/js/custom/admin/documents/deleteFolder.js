$("#delete-folder").on('click', function(e){
	
	e.preventDefault();
		var folderid = $(this).attr('data-folderId');
		var allDocumentsInFolderCount = $("#allDocumentsInFolderCount").val();
		var allChildFolders = $("#allChildFolderCount").val();
		var text = 'This folder has : \n';
		if (allDocumentsInFolderCount>0) {
			text += allDocumentsInFolderCount + ' Documents \n';
		} 
		if (allChildFolders>0) {
			text +=  ' ' + allChildFolders + ' Folders';
		}


		swal({
	        title: "Are you sure you want to delete this folder?",
	        text: text,
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, delete it!",
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
		        swal("Deleted!", "This folder has been deleted.", "success");
		    }
			}).done(function( data ){
				console.log(data);
				window.location = '/admin/document/manager';
			});
		});
});
