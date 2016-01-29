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


$('#attach-selected-files').on('click', function(){
	$("#files-selected").append('<p>Files attached :</p>');
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$("#files-selected").append('<ul class="selected-files" data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
		}
	});
});

$('#attach-selected-folders').on('click', function(){

	$("#folders-selected").empty();
	$("#folders-selected").append('<p>Folders attached :</p>');
	$('input[name^="package_folders"]').each(function(){


		var attr = $(this).attr('data-folderRoot');

		// For some browsers, `attr` is undefined; for others,
		// `attr` is false.  Check for both.
		if (typeof attr !== typeof undefined && attr !== false) {
		    
		    $("#folders-selected").append('<ul class="selected-folders" data-folderid='+ $(this).attr('data-folderid') +'>'+$(this).attr("data-foldername")+'</ul>')
		}
		
	});
});

$(document).on('click','.package-create',function(){
  	
  	var hasError = false;
 
	var packageTitle = $("#name").val();
	var package_files = [];
	var package_folders = [];
	$(".selected-files").each(function(){
		package_files.push($(this).attr('data-fileid'));
	});
	$(".selected-folders").each(function(){
		package_folders.push($(this).attr('data-folderid'));
	});
 

    if(packageTitle == '') {
		swal("Oops!", "This package needs a name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}
	console.log(package_files);
	console.log(package_folders);
    if(hasError == false) {

		$.ajax({
		    url: '/admin/package',
		    type: 'POST',
		    data: {
		  		name: packageTitle,
		  		package_files: package_files,
		  		package_folders: package_folders
		    },
		    success: function(result) {
		        console.log(result);
		        $('#createNewPackageForm')[0].reset(); // empty the form
				swal("Nice!", "'" + packageTitle +"' has been created", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});