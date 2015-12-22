$( document ).ready(function() {
  
	var communicationid = $("#communication_id").val(); 
	var storeid = $("#store_id").val(); 
	$.ajax({
		url : "/communication/" + communicationid,
	    type: 'PATCH',
	    data: {
	    	id: communicationid,
	  		store_id: storeid
	    },
	}).done(function( data ){
		console.log(data);
	});
});