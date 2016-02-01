$("#add-more-files").click(function(){
	$("#document-listing").modal('show');
});

$("#add-more-packages").click(function(){
	$("#package-listing").modal('show');
});



$('body').on('click', '#attach-selected-files', function(){
	$("#files-selected").empty();
	$("#files-selected").append('<p>Files attached :</p>');
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$("#files-selected").append('<div class="col-md-10 col-md-offset-2"><div class="row">'+
											'<div class="feature-files col-md-8 " data-fileid='+ $(this).val() +'> '+
												'<div class="feature-filename selected-files" data-fileid='+ $(this).val() +'><i class="fa fa-file-o"></i> '+  $(this).attr("data-filename")+
											'</div></div>'+
											'<a data-document-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div></div>')
		}
	});
});

$('body').on('click', '#attach-selected-packages', function(){

	console.log('attach selected-packages');
	$("#packages-selected").empty();
	$("#packages-selected").append('<p>Packages attached :</p>');
	$('input[name^="feature_packages"]').each(function(){
		if($(this).is(":checked")){
			$("#packages-selected").append('<div class="col-md-10 col-md-offset-2"><div class="row">'+
											'<div class="feature-packages col-md-8 " data-packageid='+ $(this).val() +'> '+
												'<div class="feature-packagename selected-packages" data-packageid='+ $(this).val() +'><i class="fa fa-folder-o"></i> '+  $(this).attr("data-packagename")+
											'</div></div>'+
											'<a data-package-id="'+ $(this).val()+'" id="package'+ $(this).val()+'" class="remove-staged-package btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div></div>');		
		}
		
	});
});




$(".remove-file").on('click', function(){
	var document_id = $(this).attr('data-document-id');
	$(this).parent().fadeOut(200);
	$("#files-staged-to-remove").append('<div class="remove_document"  data-documentid='+ document_id +'>')
});

$(".remove-package").on('click', function(){
	var package_id = $(this).attr('data-package-id');
	console.log(package_id);
	$(this).parent().fadeOut(200);
	
	$("#packages-staged-to-remove").append('<div class="remove_package" data-packageid='+ package_id +'>')
});

$("body").on('click', ".remove-staged-file", function(){
	
	var document_id = $(this).attr('data-document-id');
	$(".feature-files[data-fileid = '" + document_id + "']").remove();
	$(this).parent().fadeOut(200);

});

$("body").on('click', ".remove-staged-package", function(){
	
	var package_id = $(this).attr('data-packageid');
	$(".feature-packages[data-packageid = '" + package_id + "']").remove();
	$(this).parent().fadeOut(200);

});

$(document).on('click','.feature-create',function(){
  	
 
  	var hasError = false;
 
	var featureTitle = $("#feature_title").val();
	var featureTileLabel = $("#tile_label").val();
	var featureStart = $("#start").val();
	var featureEnd = $("#end").val();
	var thumbnail = $("#thumbnail")[0].files[0];
	var background = $("#background")[0].files[0];

	console.log(thumbnail);
	console.log(background);

	var feature_files = [];
	var feature_packages = [];
	$(".selected-files").each(function(){
		feature_files.push($(this).attr('data-fileid'));
	});
	$(".selected-packages").each(function(){
		feature_packages.push($(this).attr('data-packageid'));
	});
 

    if(featureTitle == '') {
		swal("Oops!", "This feature needs a name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}

	
     if(hasError == false) {
     	var data = new FormData();
     	data.append('name', featureTitle);
     	data.append('tileLabel', featureTileLabel);
     	data.append('start', featureStart);
     	data.append('end', featureEnd);
     	data.append('thumbnail', thumbnail);
     	data.append('background', background );
     	data.append('feature_files',  JSON.stringify(feature_files));
     	data.append('feature_packages',  JSON.stringify(feature_packages));
    
		$.ajax({
		    url: '/admin/feature',
		    type: 'POST',
		    data: data,
		    // {
		  		// name: featureTitle,
		  		// tileLabel : featureTileLabel,
		  		// start : featureStart,
		  		// end : featureEnd,
		  		// thumbnail : thumbnail,
		  		// background : background,
		  		// feature_files: feature_files,
		  		// feature_packages: feature_packages

		    // },
		    
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
		    success: function(result) {
		        console.log(result);
		        $('#createNewFeatureForm')[0].reset(); // empty the form
				swal("Nice!", "'" + featureTitle +"' has been created", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});