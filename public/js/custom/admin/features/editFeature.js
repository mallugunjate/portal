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

$(document).on('click','.feature-update',function(){
  	
 
  	var hasError = false;
 	var featureID = $("#featureID").val();
 	
	var featureTitle = $("#feature_title").val();
	var featureTileLabel = $("#tile_label").val();
	var featureStart = $("#start").val();
	var featureEnd = $("#end").val();
	var thumbnail = $("#thumbnail")[0].files[0];
	var background = $("#background")[0].files[0];
	var remove_document = [];
	var remove_package   = [];
	var feature_files = [];
	var feature_packages = [];

	$(".remove_document").each(function(){
		remove_document.push($(this).attr('data-documentid'));
	});
	$(".remove_package").each(function(){
		remove_package.push($(this).attr('data-packageid'));
	});
	
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

	console.log('featureID : ' + featureID);
	console.log('featureTitle : ' + featureTitle);
	console.log('featureStart : ' + featureStart);
	console.log('featureEnd : ' + featureEnd);
	console.log('thumb : ' + thumbnail);
	console.log('back : ' + background);
	console.log('remove_document : ' + remove_document);
	console.log('remove_package : ' + remove_package);
	console.log('add_document : ' + feature_files);
	console.log('add_packages : ' + feature_packages);


     if(hasError == false) {
     	var dataObj = new FormData();
     	console.log(typeof(dataObj));
     	dataObj.append('title', featureTitle);
     	dataObj.append('tileLabel', featureTileLabel);
     	dataObj.append('start', featureStart);
     	dataObj.append('end', featureEnd);
     	dataObj.append('thumbnail', thumbnail);
     	dataObj.append('background', background );
     	dataObj.append('feature_files',  JSON.stringify(feature_files));
     	dataObj.append('feature_packages',  JSON.stringify(feature_packages));
     	dataObj.append('remove_document', JSON.stringify(remove_document));
     	dataObj.append('remove_package', JSON.stringify(remove_package));

		$.ajax({
		    url: '/admin/feature/' + featureID ,
		    type: 'PATCH',
		    data: 
		    {
		  		title: featureTitle,
		  		tileLabel : featureTileLabel,
		  		start : featureStart,
		  		end : featureEnd,
		  		

		    },
		    
            processData: false,  // tell jQuery not to process the data
            contentType : false,
		    success: function(data) {
		        console.log(data);
		        
				swal("Nice!", "'" + featureTitle +"' has been created", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});