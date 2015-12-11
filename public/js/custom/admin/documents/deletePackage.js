	$("#delete-package").on('click', function(e){
		e.preventDefault();
		var package_id = $(this).attr('data-package-id');
		console.log(package_id);
		$.ajax({
			method : "DELETE",
			url : "/admin/package/" + package_id,
			data : { "_token" : $('[name="_token"]').val()}
		}).done(function( data ){
			console.log(data);
			var banner_id = $("input[name='banner_id']").val();
			window.location = '/admin/home?banner_id=' + banner_id;
		});
	});