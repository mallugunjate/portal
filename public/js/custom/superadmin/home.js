$(document).ready(function(){
	$("#admins").click(function(){
		console.log('get admin users');
		$.ajax(
			{
				url : '/admin/user'
			}
		)
		.done(function(data){
			console.log(data);
			fillUserTable(data);
		});
	});
});