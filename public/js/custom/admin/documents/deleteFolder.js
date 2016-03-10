$("#delete-folder").on('click', function(e){
	
	e.preventDefault();
		var folderid = $(this).attr('data-folderId');
		swal({
	        title: "Are you sure you want to delete this folder?",
	        //text: "You will not be able to recover this imaginary file!",
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
