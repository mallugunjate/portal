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


$('body').on('click', '#attach-selected-files', function(){
	$("#files-selected").empty();
	$("#files-selected").append('<p>Files attached :</p>');
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$("#files-selected").append('<ul class="selected-files" data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
		}
	});
});

$('body').on('click', '#attach-selected-packages', function(){

	console.log('attach selected-packages');
	$("#packages-selected").empty();
	$("#packages-selected").append('<p>Packages Attached :</p>');
	$('input[name^="packages"]:checked').each(function(){
		
			$("#packages-selected").append('<ul class="selected-packages" data-packageid='+ $(this).val() +'>'+ $(this).attr("data-package-name")+'</ul>')		
		
		
	});
});

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
	var communication_packages = [];
	var communication_documents = [];


	$(".selected-files").each(function(){
		communication_documents.push($(this).attr('data-fileid'));
	});
	
	$(".selected-packages").each(function(){
		communication_packages.push($(this).attr('data-packageid'));
	});
 
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
		  		banner_id : banner_id,
		  		target_stores : target_stores,
		  		communication_documents : communication_documents,
		  		communication_packages : communication_packages
		  		
		    },
		    success: function(result) {
		        console.log(result);
		        $('#createNewCommunicationForm')[0].reset(); // empty the form
				swal("Nice!", "'" + subject +"' has been created", "success");        
		    }
		}).done(function(response){
			//console.log(response);
		});    	
    }


    return false;
});
