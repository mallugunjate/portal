$(document).ready(function(){
	$(".delete-user").on('click', function(){
		var user_id = $(this).id;
		e.preventDefault();
		if (confirm('Are you sure you want to delete this file?')) {
		    $(this).closest('tr').fadeOut(500);
			$.ajax({
				method : "DELETE",
				url : "/admin/user/" + user_id,
				data : { "_token" : $('[name="_token"]').val()}
			}).done(function( data ){
				console.log(data);
			});
		}
	});
});