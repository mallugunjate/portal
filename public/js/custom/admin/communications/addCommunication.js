$("#attachment-Document").click(function(){
	$("#attachment-selected").empty();
	$("#document-listing").modal('show');
});

$("#attachment-Folder").click(function(){
	$("#attachment-selected").empty();
	$("#folder-listing").modal('show');
});


// $(".folder-checkbox").on('click', function(){
// 	if($(this).is(":checked")){
// 		$(this).attr('data-folderRoot', 'true')
// 		 $(this).siblings('ul')
//             .find("input[type='checkbox']")
//             .prop('checked', this.checked)
//             .attr("disabled", true);

// 	}else{
// 		$(this).removeAttr('data-folderRoot')
// 	    $(this).siblings('ul')
//             .find("input[type='checkbox']")
//             .prop('checked', false)
//             .attr("disabled", false);
// 	}	
// });

// $('#attach-selected-folders').on('click', function(){

// 	var  attachment_type = $("input[name='attachment_type']").val();
// 	var  attachment_type = $("input[name='attachment_type']").val();
// 	$("#attachment-selected").empty();
// 	$("#attachment-selected").append('<p>Folders attached :</p>');
// 	$('input[name^="package_folders"]').each(function(){


// 		var attr = $(this).attr('data-folderRoot');
		
// 		// For some browsers, `attr` is undefined; for others,
// 		// `attr` is false.  Check for both.
// 		if (typeof attr !== typeof undefined && attr !== false) {
		    
// 		    $("#attachment-selected").append('<ul class="attachment" data-attachment-type="' + attachment_type +'" data-attachmentid='+ $(this).attr('data-folderid') +'>'+$(this).attr("data-foldername")+'</ul>')
// 		}
		
// 	});

// 	$("#attachment-selected").parent().removeClass('hidden');
// });

// $('#attach-selected-files').on('click', function(){
// 	var  attachment_type = $("input[name='attachment_type']").val();
// 	$("#attachment-selected").append('<p>Files attached :</p>');
// 	$('input[name^="package_files"]').each(function(){
// 		console.log('hello');
// 		if($(this).is(":checked")){
// 			$("#attachment-selected").append('<ul class="attachment" data-attachment-type="' + attachment_type +'" data-attachmentid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
// 		}
// 	});
// 	$("#attachment-selected").parent().removeClass('hidden');
// });


// $("#allStores").change(function(){

// 	if ($("#allStores").is(":checked")) {

// 		$("#storeSelect option").each(function(index){			
// 			$(this).attr('selected', 'selected');
// 		});
// 		$("#storeSelect").chosen();
		
// 	}
// 	else if ($("#allStores").not(":checked")) {
// 		$("#storeSelect option").each(function(){
// 			$(this).removeAttr('selected');
// 		});
// 		$("#storeSelect").chosen();
		
// 	}
// });

$(document).on('click','.communication-create',function(){
  	
  	var hasError = false;
 
	var subject = $("#subject").val();
	var communication_type_id = $("input:radio[name='communication_type']:checked").val();
	var body = CKEDITOR.instances['body'].getData();
	var start = $("#send_at").val();
	var end = $("#archive_at").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	var importance = "1";
	var sender = "";
	var attachments = [];

	// console.log(target_stores);
	// console.log(communication_type_id);
 
    if(subject == '' || body == '' || start == '' || target_stores == '' || communication_type_id == '') {
		swal("Oops!", "This communication is missing something.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/communication',
		    type: 'POST',
		    data: {
		  		subject : subject,
		  		communication_type_id: communication_type_id,
		  		body : body,
		  		sender: sender,
		  		importance: importance,
		  		send_at : start,
		  		archive_at : end,
		  		// attachment_type : attachment_type,
		  		// attachments : attachments,
		  		banner_id : banner_id,
		  		target_stores : target_stores
		  		
		    },
		    success: function(result) {
		        // console.log(result);
		        $('#createNewCommunicationForm')[0].reset(); // empty the form
				swal("Nice!", "'" + subject +"' has been created", "success");        
		    }
		}).done(function(response){
			//console.log(response);
		});    	
    }


    return false;
});
