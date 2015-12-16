$(document).ready(function(){
	$(".user-create").click(function(){
		var firstname = $('input[name="firstname"]').val();
		var lastname = $('input[name="lastname"]').val();
		var email = $('input[name="email"]').val();
		var group = $('#select-group option:selected').val();
		var banners = [];
		$('#select-banner option:selected').each(function(){ banners.push($(this).val()); });

		console.log('firstname: '+ firstname );
		console.log('lastname: '+ lastname );
		console.log('email: '+ email );
		console.log('group: '+ group );
		console.log('banner: '+ banners);
	});
});