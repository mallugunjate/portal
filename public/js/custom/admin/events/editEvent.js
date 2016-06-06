$("#allStores").change(function(){

	if ($("#allStores").is(":checked")) {

		$("#storeSelect option").each(function(index){			
			$(this).attr('selected', 'selected');
		});
		$("#storeSelect").chosen();
		
	}
	else if ($("#allStores").not(":checked")) {
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen();
		
	}
});
$("body").on ('paste, keyup', '.search-field input', function() {
	processStorePaste();
});

var processStorePaste = function(){

    	var storesString = $(".search-field").find('input').val();
    	var stores = storesString.split(',');
    	$(stores).each(function(i){
    		stores[i]= stores[i].replace(/\s/g, '');
    		if(stores[i].length == 3) {
    			stores[i] = "0"+stores[i];
    		}
			$("#storeSelect option[value='"+  stores[i] +"']").attr('selected', 'selected');    		
    	});
    	
    	$("#storeSelect").val(stores).trigger("chosen:updated");
    	var selectedStoresCount = $('#storeSelect option:selected').length;
    	console.log(selectedStoresCount);
    	// $("#selectedStoresCount").append( selectedStoresCount + " stores selected" );
};

$(document).on('click','.event-update',function(){
  	
  	var hasError = false;

  	var eventID = $("#eventID").val(); 
	var eventBanner = $("#banner").val(); 
	var eventTitle = $("#title").val(); 
    var eventType = $("#event_type").val();
    var eventDescription = CKEDITOR.instances['description'].getData();
    var eventStart = $("#start").val();
    var eventEnd = $("#end").val();
    var target_stores  = $("#storeSelect").val();
	var allStores  = $("#allStores:checked").val();
	
    if(eventTitle == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	
	if(eventType == ''){
		swal("Oops!", "Event type missing", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

    if(eventStart == '' || eventEnd == '') {
		swal("Oops!", "This event needs a start and end date.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	
	if( target_stores == null && typeof allStores === 'undefined' ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/calendar/' + eventID ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	id: eventID,
		  		title: eventTitle,
		  		description: eventDescription,
		    	event_type: eventType,
		    	start: eventStart,
		    	end: eventEnd,
		    	target_stores : target_stores,
		  		allStores : allStores
		    },

		    success: function(data) {
		      console.log(data);
		        if(data != null && data.validation_result == 'false') {
		        	var errors = data.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("event_type")) {
			        	$.each(errors.title, function(index){
			        		$("#event_type").parent().append('<div class="req">' + errors.event_type[0]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("start")) {
			        	$.each(errors.title, function(index){
			        		$("#start").parent().parent().append('<div class="req">' + errors.start[0]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("end")) {
			        	$.each(errors.title, function(index){
			        		$("#end").parent().parent().append('<div class="req">' + errors.end[0]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("target_stores")) {		        	
		        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[0]  + '</div>');
		        	}
		        	if(errors.hasOwnProperty("allStores")) {		        	
		        		$("#storeSelect").parent().append('<div class="req">' + errors.allStores[0]  + '</div>');
		        	}
		        }
		        else{
		        	swal({title:"Nice!", text: "'" + eventTitle +"' has been updated", type: 'success'}, function(){
						window.location = '/admin/calendar';
					});      	
		        }

				
		    }
		});    	
    }


    return false;
});