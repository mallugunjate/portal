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
	var thumbnail = $("#thumbnail").val();
	var background = $("#background").val();
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
	console.log(feature_files);
	console.log(feature_packages);
    if(hasError == false) {

		$.ajax({
		    url: '/admin/feature',
		    type: 'POST',
		    data: {
		  		name: featureTitle,
		  		tileLabel : featureTileLabel,
		  		start : featureStart,
		  		end : featureEnd,
		  		thumbnail : thumbnail,
		  		background : background,
		  		feature_files: feature_files,
		  		feature_packages: feature_packages
		    },
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