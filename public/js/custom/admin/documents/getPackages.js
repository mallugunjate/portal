	$(".package").click(function(){
		var package_id = $(this).attr('id');
		$.ajax(
			{
				url : '/admin/package/' + package_id
			}
		)
		.done(function(data){
			showPackage(data);
		});

	})