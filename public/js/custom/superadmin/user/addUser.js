$(document).ready(function(){
	$(".user-create").click(function(){
		var firstname = $('input[name="firstname"]').val();
		var lastname = $('input[name="lastname"]').val();
		var email = $('input[name="email"]').val();

		var password = $('input[name="password"]').val();
		var confirm_password = $('input[name="confirm_password"]').val();
		var group = $('#select-group option:selected').val();
		var groupname = $('#select-group option:selected').text();
		var banners = [];
		$('#select-banner option:selected').each(function(){ banners.push($(this).val()); });

		console.log('firstname: '+ firstname );
		console.log('lastname: '+ lastname );
		console.log('email: '+ email );
		console.log('group: '+ group );
		console.log('banner: '+ banners);
		console.log('password: '+ password);
		console.log('confirm_password: '+ confirm_password);

		var hasError = false;
		if(firstname == '') {
			swal("Oops!", "Need a first name.", "error"); 
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}	

	    if(lastname == '') {
			swal("Oops!", "We need a lastname.", "error"); 
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}

	    if(email == '') {
			swal("Oops!", "We need an email.", "error"); 
			hasError = true;
			return false;
		}

		if (password == '' || confirm_password == '') {
			swal("Oops!", "Password and Confirm Password needs to be filled.", "error");
			hasError = true;
			return false;
		}

		if (password != confirm_password) {
			swal("Oops!", "Passwords do not match.", "error"); 
			hasError = true;
			return false;
		}

		if(group == '') {
			swal("Oops!", "We need an group.", "error"); 
			hasError = true;
			return false;
		}

		if(banners == '') {
			swal("Oops!", "Select a banner.", "error"); 
			hasError = true;
			return false;
		}

	    if(hasError == false) {
	    	
			$.ajax({
			    url: '/admin/user/',
			    type: 'POST',
			    data: {
			    	firstname : firstname,
			    	lastname : lastname,
			    	email : email,
			    	group : group,
			    	banners : banners,
			    	password : password
			    },
			    success: function(result) {
			        console.log(result);
			        $('form')[0].reset(); // empty the form
					swal("Nice!", groupname+ " '" + firstname + " " + lastname +"' has been created", "success");        
			    }
			}).done(function(data){
				console.log(data);
			});    	
	    }


	    return false;
	});
});
