$(document).ready(function(){
	$(".user-update").click(function(){
		var firstname = $('input[name="firstname"]').val();
		var lastname = $('input[name="lastname"]').val();
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
			    dataType: 'json',
			    data: {
			    	firstname : firstname,
			    	lastname : lastname,
			    	group : group,
			    	banners : banners,
			    	password : newPassword,
			    	password_confirmation : newPasswordConfirm
			    },
			    success: function(result) {

			    	console.log(result);
			        if(result.validation_result == 'false') {
			        	var errors = result.errors;
			        	if(errors.hasOwnProperty("firstname")) {
			        		$.each(errors.firstname, function(index){
			        			$('input[name="firstname"]').parent().append('<div class="req">' + errors.firstname[index]  + '</div>');	
			        		}); 	
			        	}
			        	
				        if(errors.hasOwnProperty("lastname")) {
				        	$.each(errors.lastname, function(index){
				        		$('input[name="lastname"]').parent().append('<div class="req">' + errors.lastname[index]  + '</div>');
				        	});
				        }
				        if(errors.hasOwnProperty("group")) {
				        	$.each(errors.group, function(index){
				        		$('#select-group').parent().append('<div class="req">' + errors.group[index]  + '</div>');	
				        	});
				        }
				        if(errors.hasOwnProperty("banners")) {
				        	$.each(errors.banners, function(index){
				        		$('#select-banner').parent().append('<div class="req">' + errors.banners[index]  + '</div>');	
				        	});
				        }
				        
				        if(errors.hasOwnProperty("password")) {
				        	$.each(errors.password, function(index){
				        		$('input[name="password"]').parent().append('<div class="req">' + errors.password[index]  + '</div>');	
				        	});
				        }
				        if(errors.hasOwnProperty("password_confirmation")) {
				        	$.each(errors.password_confirmation, function(index){
				        		$('input[name="confirm_password"]').parent().append('<div class="req">' + errors.password_confirmation[index]  + '</div>');	
				        	});
				        }
				        
			        }
			        else{
			        	console.log(result); 
						swal("Nice!", "'" + firstname +" "+ lastname +"' has been updated", "success");	
			        }
			        

			    }
			}).done(function(data){
				console.log(data);
			});    	
	    }


	    return false;
		});
})