$(document).on('click','.eventtype-create',function(){
  	
  	var hasError = false;

    var eventTypeName = $("#event_type").val();

    if(eventTypeName == '') {
		swal("Oops!", "This we need a name for this event type.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}	

	if(hasError == false) {
		$.ajax({
		    url: '/admin/eventtypes',
		    type: 'POST',
		    data: { event_type: eventTypeName },
		    success: function(result) {
		        $("#event_type").val(""); // empty the form
				swal("Nice!", "'" + eventTypeName +"' has been created", "success");        
		    }
		});
	}
	
    return false;
});