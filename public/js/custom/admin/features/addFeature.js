$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});


$("#add-packages").click(function(){
	$("#package-listing").modal('show');
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
	$("#packages-selected").append('<p>Packages attached :</p>');
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
		        // console.log(result);
		        $('#createNewFeatureForm')[0].reset(); // empty the form
				swal("Nice!", "'" + featureTitle +"' has been created", "success");        
		    }
		}).done(function(response){
			// console.log(response);
		});    	
    }


    return false;
});