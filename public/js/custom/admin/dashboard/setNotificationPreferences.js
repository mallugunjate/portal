$('input[name="latest_updates_option"]').change( function(){
	if($('input[name=latest_updates_option]').is(':checked')){
		$('input[name="update_frequency"]').prop('disabled', true).val("");
		$(this).next('input[name="update_frequency"]').prop('disabled', false);
	}
});

$("#cancel-notification-preferences").on('click', function(){
	
	var update_type_id = $("#update_type_id").val();
	var update_frequency = $("#update_window_size").val();

	$("input:radio").prop('checked', false);
	$("input[name=update_frequency]").val("");

	$("input[name='latest_updates_option'][value=" + update_type_id + "]").prop('checked', true);
	$("#latest-update-option-"+update_type_id).find("input[name='update_frequency']").val(update_frequency);

});

$(".update-notification-preferences").on('click', function(){
	
	var update_type = $('input:radio[name =  "latest_updates_option"]:checked').val();
	var update_frequency =  $('input:radio[name ="latest_updates_option"]:checked').next('input[name="update_frequency"]').val();
	
});