function updateQuicklinksOrder(data){
	console.log("made it over here");
	console.log(data);

	for(var i=0;i<data.length;i++){
        var obj = data[i];
        for(var key in obj){
            var attrName = key;
            var attrValue = obj[key];

            console.log("pos:"+ i + ", name:" + attrName + ", value:"+ attrValue);

			$.ajax({
			    url: '/admin/quicklinks/' + attrValue ,
			    type: 'PATCH',
			    data: {
			  		order: i
			    }
			  //   ,
			  //   success: function(result) {
			  //     //  $('#createNewEventForm')[0].reset(); // empty the form
					// swal("Nice!", "'" + eventType +"' has been updated", "success");        
			  //   }
			});             
        }
    }
	// if(hasError == false) {

		// $.ajax({
		//     url: '/admin/quicklinks/' + eventTypeID ,
		//     type: 'PATCH',
		//     data: {
		//   		event_type: eventType
		//     },
		//     success: function(result) {
		//       //  $('#createNewEventForm')[0].reset(); // empty the form
		// 		swal("Nice!", "'" + eventType +"' has been updated", "success");        
		//     }
		// });    	
 //    }
}