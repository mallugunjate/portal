$("#add-more-files").click(function(){
	$("#document-listing").modal('show');
});

$("#add-more-packages").click(function(){
	$("#package-listing").modal('show');
});



$('body').on('click', '#attach-selected-files', function(){
	$("#files-selected").empty();
	// $("#files-selected").append('<label class="control-label col-sm-2">Files attached</label>');
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$("#files-selected").append('<div class="col-sm-10 col-sm-offset-2"><div class="row">'+
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
	// $("#packages-selected").append('<label class="control-label col-sm-2">Packages Attached</label>');
	$('input[name^="feature_packages"]').each(function(){
		if($(this).is(":checked")){
			$("#packages-selected").append('<div class="col-sm-10 col-sm-offset-2"><div class="row">'+
											'<div class="feature-packages col-sm-8 " data-packageid='+ $(this).val() +'> '+
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

$('input[id="thumbnail"]').on('change', function(){

	var featureID = $("#featureID").val();
	var thumbnail = $('input[id="thumbnail"]')[0].files[0];
	console.log(featureID);
	var data = new FormData();
	data.append('thumbnail', thumbnail);
	data.append('featureID', featureID);
	console.log(data);
	$.ajax({
		    url: '/admin/feature/thumbnail',
		    type: 'POST',
		    data: data, 
		    dataType: 'json',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
		    success: function(result) {
		        console.log(result);
		        $(".thumbnail-preview img").attr('src', "/images/featured-covers/"+result);
		        // $('#createNewFeatureForm')[0].reset(); // empty the form
				// swal("Nice!", "'" + featureTitle +"' has been created", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    

});

$('input[id="background"]').on('change', function(){

	var featureID = $("#featureID").val();
	var background = $('input[id="background"]')[0].files[0];
	var data = new FormData();
	data.append('background', background);
	data.append('featureID', featureID);

	$.ajax({
		    url: '/admin/feature/background',
		    type: 'POST',
		    data: data, 
		    dataType: 'json',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
		    success: function(result) {
		        console.log(result);
		        $(".background-preview img").attr('src', "/images/featured-backgrounds/"+result);
		        // $('#createNewFeatureForm')[0].reset(); // empty the form
				// swal("Nice!", "'" + featureTitle +"' has been created", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    

});

$('input[name="latest_updates_option"]').change( function(){
	if($('input[name=latest_updates_option]').is(':checked')){
		$('input[name="update_frequency"]').prop('disabled', true).val("");
		$(this).next('input[name="update_frequency"]').prop('disabled', false);
	}
});

$(document).on('click','.feature-update',function(){
  	
 
  	var hasError = false;
 	var featureID = $("#featureID").val();
 	
	var featureTitle = $("#feature_title").val();
	var featureTileLabel = $("#tile_label").val();
	var featureStart = $("#start").val();
	var featureEnd = $("#end").val();
	var thumbnail = $('input[id="thumbnail"]')[0].files[0];
	var background = $('input[id="background"]')[0].files[0];
	var remove_document = [];
	var remove_package   = [];
	var feature_files = [];
	var feature_packages = [];
	var update_type = $('input:radio[name =  "latest_updates_option"]:checked').val();
	var update_frequency =  $('input:radio[name ="latest_updates_option"]:checked').next('input[name="update_frequency"]').val();
	console.log('latest updates : ' + update_type);
	console.log('latest update freq : ' + update_frequency);


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
		return false;
	}
	if(featureStart == '' || featureEnd == '') {
		swal("Oops!", "Start and end dates cannot be empty", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(update_frequency == '') {
		swal("Oops!", "Notification window size cannot be empty", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;	
	}

     if(hasError == false) {
     	var dataObj = {};
     	console.log(typeof(dataObj));
     	$.extend(dataObj, {title: featureTitle});
     	$.extend(dataObj, {tileLabel: featureTileLabel});
     	$.extend(dataObj, {start: featureStart});
     	$.extend(dataObj, {end: featureEnd});
     	$.extend(dataObj, {feature_files:  feature_files});
     	$.extend(dataObj, {feature_packages:  feature_packages});
     	$.extend(dataObj, {remove_document: remove_document});
     	$.extend(dataObj, {remove_package: remove_package});
     	$.extend(dataObj, {update_type : update_type});
     	$.extend(dataObj, {update_frequency : update_frequency});
     	

     	var data = JSON.stringify(dataObj);
     	console.log(dataObj);
     	console.log(data);

		$.ajax({
		    url: '/admin/feature/' + featureID ,
		    type: 'PATCH',
		    data: data,
		    contentType: 'application/json',
		    dataType: 'json',
		    processData : false,
		    success: function(result) {

	        	var errors = result.errors;
	        	if(errors.hasOwnProperty("name")) {
	        		$.each(errors.name, function(index){
	        			$("#feature_title").parent().append('<div class="req">' + errors.name[index]  + '</div>');	
	        		}); 	
	        	}
		        if(errors.hasOwnProperty("documents")) {
		        	$.each(errors.documents, function(index){
		        		$("#files-selected").append('<div class="req">' + errors.documents[index]  + '</div>');
		        	});
		        }
		        if(errors.hasOwnProperty("packages")) {
		        	$.each(errors.packages, function(index){
		        		$("#packages-selected").append('<div class="req">' + errors.packages[index]  + '</div>');	
		        	});
		        }
		        if(errors.hasOwnProperty("update_type_id")) {
		        	$.each(errors.update_type_id, function(index){
		        		$(".latest-updates-container").append('<div class="req">' + errors.update_type_id[index]  + '</div>');	
		        	});
		        }
		        if(errors.hasOwnProperty("update_frequency")) {
		        	$.each(errors.update_frequency, function(index){
		        		$(".latest-updates-container").append('<div class="req">' + errors.update_frequency[index]  + '</div>');	
		        	});
		        }
		        
		        if(errors.hasOwnProperty("start")) {
		        	$.each(errors.start, function(index){
		        		$(".input-daterange").parent().append('<div class="req">' + errors.start[index]  + '</div>');	
		        	});
		        }
		        if(errors.hasOwnProperty("end")) {
		        	$.each(errors.end, function(index){
		        		$(".input-daterange").append('<div class="req">' + errors.end[index]  + '</div>');	
		        	});
		        }
		        if(errors.hasOwnProperty("thumbnail")) {
		        	$.each(errors.thumbnail, function(index){
		        		$("#thumbnail").append('<div class="req">' + errors.thumbnail[index]  + '</div>');	
		        	});
		        }
		        if(errors.hasOwnProperty("background")) {
		        	$.each(errors.background, function(index){
		        		$("#background").append('<div class="req">' + errors.background[index]  + '</div>');	
		        	});
		        }
	        
		        else{
		        	swal("Nice!", "'" + featureTitle +"' has been updated", "success");
			    }
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});