$(document).on('click','.event-update',function(){
  	
  	var hasError = false;

  	var eventID = $("#eventID").val(); 
	var eventBanner = $("#banner").val(); 
	var eventTitle = $("#title").val(); 
    var eventType = $("#event_type").val();
    var eventDescription = $("#description").val();
    var eventStart = $("#start").val();
    var eventEnd = $("#end").val();
    var tags = $('#tags').val();

    console.log(tags);
    if(eventTitle == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	

    if(eventStart == '') {
		swal("Oops!", "This event needs a start date.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}	

    if(hasError == false) {

		$.ajax({
		    url: '/admin/calendar/' + eventID ,
		    type: 'PATCH',
		    data: {
		    	id: eventID,
		  		title: eventTitle,
		  		description: eventDescription,
		    	event_type: eventType,
		    	start: eventStart,
		    	end: eventEnd,
		    	tags: tags
		    },
		    success: function(result) {
		      //  $('#createNewEventForm')[0].reset(); // empty the form
				swal("Nice!", "'" + eventTitle +"' has been updated", "success");        
		    }
		});    	
    }


    return false;
});