$(document).ready(function(){

	$("body").on('click', '.delete-user', function(e){
		console.log('delete called');
		var user_id = e.target.id;
		console.log(user_id);
		e.preventDefault();
		if (confirm('Are you sure you want to delete this user?')) {
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