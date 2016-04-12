var setNotificationType = function(){
	
	var update_type_id = $("#update_type_id").val();
	var update_frequency = $("#update_window_size").val();

	$("input:radio").prop('checked', false);
	$("input[name=update_frequency]").val('');

	$("input[name='latest_updates_option'][value=" + update_type_id + "]").prop('checked', true);
	$("#latest-update-option-"+update_type_id).find("input[name='update_frequency']").val(update_frequency);
}


$('input[name="latest_updates_option"]:radio').on('change', function(){

	if($('input[name=latest_updates_option]').is(':checked')){
		$('input[name="update_frequency"]').prop('disabled', true).val("");
		$(this).next('input[name="update_frequency"]').prop('disabled', false);
	}
});

$("#cancel-notification-preferences").on('click', function(){
	
	setNotificationType();

});

$(".update-notification-preferences").on('click', function(){
	
	var hasError = false;
	var banner_id = $("#banner_id").val();
	var update_type = $('input:radio[name =  "latest_updates_option"]:checked').val();
	var update_frequency =  $('input:radio[name ="latest_updates_option"]:checked').next('input[name="update_frequency"]').val();
	var request_type = 'updateNotificationPreference'
	

	if(update_type == '' || update_frequency == '') {
		swal("Oops!", "Oops! Missing Preferences.", "error"); 
		hasError = true;
	}


	if(hasError == false) {
		$.ajax({
		    url: '/admin/dashboard/' + banner_id,
		    type: 'PATCH',
		   	dataType: 'json',
		    data: { update_type: update_type, update_frequency: update_frequency , request_type : request_type},

		    success: function(result) {
		        
		        console.log(result); 
		        if(result.validation_result == 'false') {
                  var errors = result.errors;
                  if(errors.hasOwnProperty("update_type_id")) {
                    $.each(errors.update_type_id, function(index){
                      $(".latest-updates-container").parent().parent().append('<div class="req">' + errors.update_type_id[index]  + '</div>'); 
                    });   
                  }
                  if(errors.hasOwnProperty("update_window_size")) {
                    $.each(errors.update_window_size, function(index){
                      $(".latest-updates-container").parent().parent().append('<div class="req">' + errors.update_window_size[index]  + '</div>'); 
                    });   
                  }
                }
		        else{
		        	$('#update_type_id').val(result.update_type_id);
		        	$("#update_window_size").val(result.update_window_size);
					swal("Nice!", "Preferences have been updated", "success");
		        }
		        


		    }
		}).done(function(response){
			console.log(response);
		});  
	}	
});

