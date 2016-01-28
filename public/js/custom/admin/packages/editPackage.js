$(document).ready(function(){

	
	$('#attach-selected-files').on('click', function(){
		// $("#files-selected").append('<p>Files attached :</p>');
		$("#files-selected").empty();
		$('input[name^="package_files"]').each(function(){
			if($(this).is(":checked")){
				$("#files-selected").append('<div class="col-md-10 col-md-offset-2"><div class="row">'+
											'<div class="package-files col-md-8 " data-fileid='+ $(this).val() +'> '+
												'<div class="package-filename selected-files" data-fileid='+ $(this).val() +'><i class="fa fa-file-o"></i> '+  $(this).attr("data-filename")+
											'</div></div>'+
											'<a data-document-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div></div>');
			}
		});
	});

	$('#attach-selected-folders').on('click', function(){

		$("#folders-selected").empty();
		
		$('input[name^="package_folders"]').each(function(){


			var attr = $(this).attr('data-folderRoot');

			// For some browsers, `attr` is undefined; for others,
			// `attr` is false.  Check for both.
			if (typeof attr !== typeof undefined && attr !== false) {
			    
			    $("#folders-selected").append(	'<div class="col-md-10 col-md-offset-2"><div class="row">'+			    								'<div class="package-folders col-md-8 " data-folderid='+ $(this).attr('data-folderid') +'>'+
			    									'<div class="package-foldername selected-folders" data-folderid='+ $(this).attr('data-folderid') +'><i class="fa fa-folder-o"></i> '+ $(this).attr("data-foldername")+
			    									'</div></div>'+
			    								'<a data-folder-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-folder btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div></div>');
			}
			
		});
	});

	

});



$("#add-more-files").on('click', function(){
	$("#document-listing").modal('show');
})
$("#add-more-folders").on('click', function(){

	$("#folder-listing").modal('show');
})

$(".remove-file").on('click', function(){
	var document_id = $(this).attr('data-document-id');
	$(this).parent().fadeOut(200);
	$("#files-staged-to-remove").append('<div class="remove_document"  data-documentid='+ document_id +'>')
});

$("body").on('click', ".remove-staged-file", function(){
	
	$(".package-files[data-fileid = '" + document_id + "']").remove();
	var document_id = $(this).attr('data-document-id');
	$(this).parent().fadeOut(200);

});
$("body").on('click', ".remove-staged-folder", function(){
	
	
	var folder_id = $(this).attr('data-folder-id');
	$(this).parent().fadeOut(200);
	$(".package-folders[data-folderid = '" + folder_id + "']").remove();

});

$(".remove-folder").on('click', function(){
	var folder_id = $(this).attr('data-folder-id');
	console.log(folder_id);
	$(this).parent().fadeOut(200);
	
	$("#folders-staged-to-remove").append('<div class="remove_folder" data-folderid='+ folder_id +'>')
});

$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});


$("#add-folders").click(function(){
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

$(".package-update").on('click', function(){
	console.log("update received");
	var hasError = false;
 
	var packageTitle = $("#name").val();
	var packageID = $("#packageID").val();
	var package_files = [];
	var package_folders = [];
	var remove_document = [];
	var remove_folder   = [];

	$(".selected-files").each(function(){
		package_files.push($(this).attr('data-fileid'));
	});
	$(".selected-folders").each(function(){
		package_folders.push($(this).attr('data-folderid'));
	});
	$(".remove_document").each(function(){
		remove_document.push($(this).attr('data-documentid'));
	});
	$(".remove_folder").each(function(){
		remove_folder.push($(this).attr('data-folderid'));
	});
 	

    if(packageTitle == '') {
		swal("Oops!", "This package needs a name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}

	console.log('remove_folder');
	console.log(remove_folder);


    if(hasError == false) {

		$.ajax({
		    url: '/admin/package/' + packageID ,
		    type: 'PATCH',
		    data: {
		  		name: packageTitle,
		  		package_files: package_files,
		  		package_folders: package_folders,
		  		remove_document : remove_document,
		  		remove_folder : remove_folder

		    },
		    success: function(result) {
		        console.log(result);
		        //$('#createNewPackageForm')[0].reset(); // empty the form
				swal("Nice!", "'" + packageTitle +"' has been updated", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});
