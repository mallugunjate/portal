$(document).on('click','.eventtype-edit',function(){
  	
  	var hasError = false;

  	var eventTypeID = $("#eventTypeID").val();  
	var eventType = $("#event_type").val(); 

    if(eventType == '') {
		swal("Oops!", "This event type needs a name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}	
	
    if(hasError == false) {

		$.ajax({
		    url: '/admin/eventtypes/' + eventTypeID ,
		    type: 'PATCH',
		    data: {
		  		event_type: eventType
		    },
		    success: function(result) {
		      //  $('#createNewEventForm')[0].reset(); // empty the form
				swal("Nice!", "'" + eventType +"' has been updated", "success");        
		    }
		});    	
    }


    return false;
});