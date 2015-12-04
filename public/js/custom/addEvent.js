$(document).on('click','.event-create',function(){
  
  	var eventBanner = $("#banner").val(); 
	var eventTitle = $("#title").val(); 
    var eventType = $("#event_type").val();
    var eventDescription = $("#description").val();
    var eventStart = $("#start").val();
    var eventEnd = $("#end").val();

	$.ajax({
	    url: '/admin/calendar',
	    type: 'POST',
	    data: {
	    	banner: eventBanner,
	  		title: eventTitle,
	  		description: eventDescription,
	    	event_type: eventType,
	    	start: eventStart,
	    	end: eventEnd
	    },
	    success: function(result) {
	        $('#createNewEventForm')[0].reset(); // empty the form
			swal("Nice!", "'" + eventTitle +"' has been created", "success");        
	    }
	});

    return false;
});