	$("body").on("click", ".deleteFile", function(e) {
		console.log("file delete requested");
		e.preventDefault();
		if (confirm('Are you sure you want to delete this file?')) {
		    $(this).closest('tr').fadeOut(500);
			$.ajax({
			    url: '/admin/document/'+ this.id,
			    type: 'DELETE',
			    data : {	
			    			_token : $('[name=_token').val()
					   }

			})
			.done(function(data) {
				console.log(data);
			});
		} 
	});