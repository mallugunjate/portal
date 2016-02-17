$(document).ready(function(){
	$(".user-update").click(function(){
		var firstname = $('input[name="firstname"]').val();
		var lastname = $('input[name="lastname"]').val();
		var email = $('input[name="email"]').val();
		var group = $('#select-group option:selected').val();
		var banners = [];
		$('#select-banner option:selected').each(function(){ banners.push($(this).val()); });

		var newPassword = $('input[name="password"]').val();
		var newPasswordConfirm = $('input[name="confirm_password"]').val();

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
			$(window).scrollTop(0);
			return false;
		}

		if(group == '') {
			swal("Oops!", "We need an group.", "error"); 
			hasError = true;
			$(window).scrollTop(0);	
			return false;
		}

		if(banners == '') {
			swal("Oops!", "Select a banner.", "error"); 
			hasError = true;
			$(window).scrollTop(0);	
			return false;
		}

		if (newPassword != newPasswordConfirm) {
			swal("Oops!", "Passwords do not match", "error"); 
			hasError = true;
			$(window).scrollTop(0);	
			return false;
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
			    	banners : banners,
			    	password : newPassword
			    },
			    success: function(data) {
			        
			        console.log(data); 
					swal("Nice!", "'" + firstname +" "+ lastname +"' has been updated", "success");

			    }
			}).done(function(data){
				console.log(data);
			});    	
	    }


	    return false;
		});
})