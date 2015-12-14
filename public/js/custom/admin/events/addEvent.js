$(document).on('click','.event-create',function(){
  	
  	var hasError = false;

  	var eventBanner = $("#banner").val(); 
	var eventTitle = $("#title").val(); 
    var eventType = $("#event_type").val();
    var eventDescription = $("#description").val();
    var eventStart = $("#start").val();
    var eventEnd = $("#end").val();
    var tags = $('#tags').val();

    console.log("tags" + tags);
    if(eventTitle == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}	

    if(eventBanner == '') {
		swal("Oops!", "We need a banner.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}

    if(eventStart == '') {
		swal("Oops!", "This event needs a start date.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}	

    if(hasError == false) {

		$.ajax({
		    url: '/admin/calendar',
		    type: 'POST',
		    data: {
		    	banner: eventBanner,
		  		title: eventTitle,
		  		description: eventDescription,
		    	event_type: eventType,
		    	start: eventStart,
		    	end: eventEnd,
		    	tags: tags
		    },
		    success: function(result) {
		        console.log(result);
		        $('#createNewEventForm')[0].reset(); // empty the form
				swal("Nice!", "'" + eventTitle +"' has been created", "success");        
		    }
		});    	
    }


    return false;
});