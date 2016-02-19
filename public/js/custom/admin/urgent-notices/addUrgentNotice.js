$("#attachment-Document").click(function(){
	$("#attachment-selected").empty();
	$("#document-listing").modal('show');
});

$("#attachment-Folder").click(function(){
	$("#attachment-selected").empty();
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

	var  attachment_type = $("input[name='attachment_type']").val();
	var  attachment_type = $("input[name='attachment_type']").val();
	$("#attachment-selected").empty();
	$("#attachment-selected").append('<p>Folders attached :</p>');
	$('input[name^="package_folders"]').each(function(){


		var attr = $(this).attr('data-folderRoot');
		
		// For some browsers, `attr` is undefined; for others,
		// `attr` is false.  Check for both.
		if (typeof attr !== typeof undefined && attr !== false) {
		    
		    $("#attachment-selected").append('<ul class="attachment" data-attachment-type="' + attachment_type +'" data-attachmentid='+ $(this).attr('data-folderid') +'>'+$(this).attr("data-foldername")+'</ul>')
		}
		
	});

	$("#attachment-selected").parent().removeClass('hidden');
});

$('#attach-selected-files').on('click', function(){
	var  attachment_type = $("input[name='attachment_type']").val();
	$("#attachment-selected").append('<p>Files attached :</p>');
	$('input[name^="package_files"]').each(function(){
		console.log('hello');
		if($(this).is(":checked")){
			$("#attachment-selected").append('<ul class="attachment" data-attachment-type="' + attachment_type +'" data-attachmentid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
		}
	});
	$("#attachment-selected").parent().removeClass('hidden');
});


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

$(document).on('click','.urgentnotice-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var start = $("#start").val();
	var end = $("#end").val();
	var attachment_type  = $("input[name='attachment_type']:checked").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	var attachments = [];

	console.log(target_stores);

	$(".attachment").each(function(){
		attachments.push($(this).attr('data-attachmentid'));
	});

 
	console.log(description);
    if(title == '' || description == '' || start == '') {
		swal("Oops!", "This notice is not complete.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/urgentnotice',
		    type: 'POST',
		    data: {
		  		title : title,
		  		description : description,
		  		start : start,
		  		end : end,
		  		attachment_type : attachment_type,
		  		attachments : attachments,
		  		banner_id : banner_id,
		  		target_stores : target_stores
		  		
		    },
		    success: function(result) {
		        console.log(result);
		        $('#createNewUrgentNoticeForm')[0].reset(); // empty the form
				swal("Nice!", "'" + title +"' has been created", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});
