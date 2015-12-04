$(document).on('click','.eventtype-create',function(){
  
    var eventTypeName = $("#event_type").val();

	$.ajax({
	    url: '/admin/eventtypes',
	    type: 'POST',
	    data: { event_type: eventTypeName },
	    success: function(result) {
	        $("#event_type").val(""); // empty the form
			swal("Nice!", "'" + eventTypeName +"' has been created", "success");        
	    }
	});

    return false;
});