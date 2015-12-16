$(document).ready(function(){
	$(".user-update").click(function(){
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
		console.log('banner: '+ typeof(banners) );

		var hasError = false;
		if(firstname == '') {
		swal("Oops!", "Need a first name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		}	

	    if(lastname == '') {
			swal("Oops!", "We need a lastname.", "error"); 
			hasError = true;
			$(window).scrollTop(0);
		}

	    if(email == '') {
			swal("Oops!", "We need an email.", "error"); 
			hasError = true;
			$(window).scrollTop(0);
		}

		if(group == '') {
			swal("Oops!", "We need an group.", "error"); 
			hasError = true;
			$(window).scrollTop(0);	
		}

		if(banners == '') {
			swal("Oops!", "Select a banner.", "error"); 
			hasError = true;
			$(window).scrollTop(0);	
		}

	    if(hasError == false) {
	    	var userId = $('input[name="userId"]').val();
			$.ajax({
			    url: '/admin/user/' + userId ,
			    type: 'PATCH',
			    data: {
			    	firstname : firstname,
			    	lastname : lastname,
			    	email : email,
			    	group : group,
			    	banners : banners
			    }
			}).done(function(data){
				console.log(data);
			});    	
	    }


	    return false;
		});
})