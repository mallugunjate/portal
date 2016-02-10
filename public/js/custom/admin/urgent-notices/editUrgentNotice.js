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

$("body").on('click', "#add-more-documents", function(){
	$("#document-listing").modal('show');
});

$("body").on('click', "#add-more-folders", function(){
	$("#folder-listing").modal('show');
});

$(".folder-checkbox").on('click', function(){
	if($(this).is(":checked")){
		$(this).attr('data-folderRoot', 'true')
		 $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked)
            .attr("disabled", true);

	}else{
		$(this).removeAttr('data-folderRoot')
	    $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', false)
            .attr("disabled", false);
	}	
});


$('#attach-selected-folders').on('click', function(){

	var  attachment_type = $("input[name='attachment_type']:checked").val();
	
	$("#attachment-selected").empty();
	$("#attachment-selected").append('<p>Additional Folders attached :</p>');
	$('input[name^="package_folders"]').each(function(){


		var attr = $(this).attr('data-folderRoot');
		
		if (typeof attr !== typeof undefined && attr !== false) {
		    
		    $("#attachment-selected").append('<div class="attachment new-attachment col-md-8" data-attachment-type="' + attachment_type +'" data-attachmentid='+ $(this).attr('data-folderid') +'>'+
									    		'<i class="fa fa-folder"></i> '+$(this).attr("data-foldername")+
									    		
									    	'</div>'+
									    	'<a data-attachment-type="' + attachment_type +'" data-attachmentid="' + $(this).attr('data-folderid') + '"' +
									    			'id="folder' + $(this).attr('data-folderid') + '"' +
									    			'class="remove-staged-folder btn btn-danger btn-sm">'+ 
									    		'<i class="fa fa-trash"></i>'+
									    	'</a>');
		}
		
	});

	$("#attachment-selected").parent().removeClass('hidden');
});

$('#attach-selected-files').on('click', function(){
	var  attachment_type = $("input[name='attachment_type']:checked").val();
	$("#attachment-selected").empty();
	$("#attachment-selected").append('<p>Additional Documents attached :</p>');
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$("#attachment-selected").append('<div class="attachment new-attachment col-md-8" data-attachment-type="' + attachment_type +'" data-attachmentid='+ $(this).val() +'>'+
												'<i class="fa fa-file"></i> '+$(this).attr("data-filename")+
												
											'</div>'+
											'<a data-attachment-type="' + attachment_type +'" data-attachmentid="' + $(this).val() + '"'+
													' id="file' + $(this).val() + '"'+
													' class="remove-staged-file btn btn-danger btn-sm">'+
												'<i class="fa fa-trash"></i>'+
											'</a>');
		}
	});
	$("#attachment-selected").parent().removeClass('hidden');
});


$(".remove-file").on('click', function(){
	var document_id = $(this).attr('data-attachmentid');
	$(this).parent().fadeOut(200);
	$("#attachments-staged-to-remove").append('<div class="remove_attachment" data-attachment-type = 2  data-attachmentid='+ document_id +'>')
});

$(".remove-folder").on('click', function(){
	console.log($(this));
	var folder_id = $(this).attr('data-attachmentid');
	$(this).parent().fadeOut(200);
	$("#attachments-staged-to-remove").append('<div class="remove_attachment" data-attachment-type = 1 data-attachmentid='+ folder_id +'>')
});

$("body").on('click', ".remove-staged-file", function(){
	
	$("div.new-attachment[data-attachmentid='"+$(this).attr('data-attachmentid')+"']").fadeOut(200).remove();
	$(this).fadeOut(200).remove();

});

$("body").on('click', ".remove-staged-folder", function(){
		
	$("div.new-attachment[data-attachmentid='"+$(this).attr('data-attachmentid')+"']").fadeOut(200).remove();
	$(this).fadeOut(200).remove();

});



$("input[name='attachment_type']").on('change', function(){
	
	var updated_attachment_type = ($("input[name='attachment_type']:checked").val());
	var last_selected_attachment_type = $("#attachment_type_selected_latest").val();

	console.log(last_selected_attachment_type);
	console.log(updated_attachment_type);

	if(updated_attachment_type != last_selected_attachment_type) {
		
		
		// var attachment_type = $(".attachments:first").attr('data-attachment-type');
		var attachment_type = last_selected_attachment_type;
		if(attachment_type == 1) {
			
			$("#add-more-folders").parent().append('<div id="add-more-documents" class="btn btn-primary btn-outline col-md-offset-2" role="button" >'+
		                                       			'<i class="fa fa-plus"></i> Add More Documents'+
		                                       		'</div>');
			$("#add-more-folders").remove();
		}
		else{
			
			$("#add-more-documents").parent().append('<div id="add-more-folders" class="btn btn-primary btn-outline col-md-offset-2" role="button" >'+
		                                       			'<i class="fa fa-plus"></i> Add More Folders'+
		                                       		'</div>');
			$("#add-more-documents").remove();

		}

		$("#attachment-selected").empty();
		$(".attachments").each(function(){
			$("#attachments-staged-to-remove").append('<div class="remove_attachment" data-attachment-type='+ attachment_type +' data-attachmentid='+ $(this).attr('data-attachmentid') +'>')	
			$(this).fadeOut(300);
		});
	}

	$("#attachment_type_selected_latest").val(updated_attachment_type);	
});



$(document).ready(function(){
	var attachment_type_selected = $("#attachment_type_selected").val();
	$("input[name='attachment_type'][value="+ attachment_type_selected+"]").prop('checked', true);

});

$(document).on('click','.urgentnotice-update',function(){
  	
  	var hasError = false;
 	var urgent_notice_id = $("#urgent_noticeID").val();
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var start = $("#start").val();
	var end = $("#end").val();
	var new_attachment_type  = $("input[name='attachment_type']:checked").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	var new_attachments = [];
	var remove_attachments = [];

	

	$(".new-attachment").each(function(){
		new_attachments.push($(this).attr('data-attachmentid'));
	});

	$("#attachments-staged-to-remove").children().each(function(){

		remove_attachments.push($(this).attr('data-attachmentid'));
	});
	
	console.log(remove_attachments);
 
    if(title == '' || description == '' || start == '') {
		swal("Oops!", "This notice is not complete.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/urgentnotice/' + urgent_notice_id,
		    type: 'PATCH',
		    data: {
		  		title : title,
		  		description : description,
		  		start : start,
		  		end : end,
		  		new_attachment_type : new_attachment_type,
		  		new_attachments : new_attachments,
		  		remove_attachments : remove_attachments,
		  		banner_id : banner_id,
		  		target_stores : target_stores
		  		
		    },
		    success: function(result) {
		        console.log(result);
		        // $('#createNewUrgentNoticeForm')[0].reset(); // empty the form
				swal("Nice!", "'" + title +"' has been updated", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});
