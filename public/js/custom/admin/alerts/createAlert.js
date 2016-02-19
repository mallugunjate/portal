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

$(document).on('click','.alert-create',function(){
  	
  	var hasError = false;
 	
 	var document_id = $("#documentID").val();
	var title = $("#title").val();
	var description = $("#description").val();
	var document_start = $("#document_start").val();
	var document_end = $("#document_end").val();

	var is_alert = 0;
	if ($("#is_alert").prop("checked")){
		is_alert = 1;	
	}
	var alert_type_id = $("#alert_type").val();
	
	var start = $("#start").val();
	var end = $("#end").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	 
	console.log('title : ' + title);
	console.log('description : ' + description);
	console.log('is_alert : ' + is_alert); 
	console.log('alert_type : '+ alert_type_id);
	console.log('start : ' + start);
	console.log('end : ' + end);
	console.log('target_stores : ' + target_stores);
	console.log('banner_id : ' + banner_id);

    if(title == '') {
		swal("Oops!", "This communication is missing something.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/document/' + document_id ,
		    type: 'PATCH',
		    data: {
		  		title : title,
		  		description: description,
		  		is_alert : is_alert,
		  		alert_type_id : alert_type_id,
		  		start : start,
		  		end: end,
		  		banner_id : banner_id,
		  		target_stores : target_stores,
		  		document_start : document_start,
		  		document_end : document_end,
		  		
		    },
		    success: function(result) {
		        console.log(result);
		        // $('#createNewCommunicationForm')[0].reset(); // empty the form
				swal("Nice!", "'" + title +"' has been updated", "success");        
		    }
		}).done(function(response){
			//console.log(response);
		});    	
    }


    return false;
});
