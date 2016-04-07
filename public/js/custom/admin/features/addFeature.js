$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});


$("#add-packages").click(function(){
	$("#package-listing").modal('show');
});

$('input[name="latest_updates_option"]').change( function(){
	if($('input[name=latest_updates_option]').is(':checked')){
		console.log($(this).next('input[name="update_frequency"]'));
		$('.update_frequency').prop( "disabled", true );
		$(this).next('.update_frequency').prop( "disabled", false );
	}
});

$('body').on('click', '#attach-selected-files', function(){
	$("#files-selected").empty();
	$("#files-selected").append('<p>Files Attached :</p>');
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
	$('input[name^="feature_packages"]').each(function(){
		if($(this).is(":checked")){
			$("#packages-selected").append('<ul class="selected-packages" data-packageid='+ $(this).attr('data-packageid') +'>'+ $(this).attr("data-packagename")+'</ul>')		
		}
		
	});
});

$(document).on('click','.feature-create',function(){
  	
 
  	var hasError = false;
 
	var featureTitle = $("#feature_title").val();
	var featureTileLabel = $("#tile_label").val();
	var featureStart = $("#start").val();
	var featureEnd = $("#end").val();
	var thumbnail = $("#thumbnail")[0].files[0];
	var background = $("#background")[0].files[0];
	var update_type = $('input:radio[name =  "latest_updates_option"]:checked').val();
	var update_frequency =  $('input:radio[name ="latest_updates_option"]:checked').next(".update_frequency").val();

	console.log(thumbnail);
	console.log(background);
	console.log(update_type);
	console.log(update_frequency);
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
		return false;
	}
	if(featureStart == '' || featureEnd == '') {
		swal("Oops!", "This feature needs start and end dates.", "error"); 
		hasError = true;
		return false;
	}

	if (typeof update_type === 'undefined' || update_frequency == '') {
		swal("Oops!", "Update type and update window size needs to be filled", "error"); 
		hasError = true;
		return false;
	};

	
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
    	data.append('update_type', update_type);
    	data.append('update_frequency', update_frequency);

		$.ajax({
		    url: '/admin/feature',
		    type: 'POST',
		    data: data, 
		    dataType: 'json',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
		    success: function(result) {
		        console.log(result);
		    	if(result != null && result.validation_result == 'false') {
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
		        }
		        else{
		        	$('#createNewFeatureForm')[0].reset(); // empty the form
					swal("Nice!", "'" + featureTitle +"' has been created", "success");
		        }

		        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});