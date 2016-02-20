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

$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});

$("#add-packages").click(function(){
	$("#package-listing").modal('show');	
});


$(document).on('click','.communication-update',function(){
  	
 
  	var hasError = false;
 	var communicationId = $("#communicationId").val();
 	
 	var subject = $("#subject").val();
	var communication_type_id = $("input:radio[name='communication_type']:checked").val();
	var body = CKEDITOR.instances['body'].getData();
	var start = $("#send_at").val();
	var end = $("#archive_at").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	var allStores  = $("allStores:checked").val();
	var importance = "1";
	var sender = "";

	var remove_document = [];
	var remove_package   = [];
	var communication_documents = [];
	var communication_packages = [];


	$(".remove_document").each(function(){
		remove_document.push($(this).attr('data-documentid'));
	});
	$(".remove_package").each(function(){
		remove_package.push($(this).attr('data-packageid'));
	});
	
	$(".selected-files").each(function(){
		communication_documents.push($(this).attr('data-fileid'));
	});
	$(".selected-packages").each(function(){
		communication_packages.push($(this).attr('data-packageid'));
	});
 

     if(subject == '' || body == '') {
		swal("Oops!", "Communication title/body incomplete.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(  start == '' || end == '' ) {
		swal("Oops!", "Start and end dated needed.", "error"); 
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
	console.log(communication_type_id);
     if(hasError == false) {


		$.ajax({
		    url: '/admin/communication/' + communicationId,
		    type: 'PATCH',
		    data: {

		    	subject : subject,
		  		communication_type_id: communication_type_id,
		  		body : body,
		  		sender: sender,
		  		importance: importance,
		  		send_at : start,
		  		archive_at : end,
		  		banner_id : banner_id,
		  		target_stores : target_stores,
		  		communication_documents : communication_documents,
		  		communication_packages : communication_packages,
		  		remove_document : remove_document,
		  		remove_package : remove_package

		    },
		    
		    success: function(data) {
		        
		        console.log(data); 
				swal("Nice!", "'" + subject +"' has been updated", "success");

		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});