$("#add-videos").click(function(){
	$("#video-listing").modal('show');
});


$('body').on('click', '#attach-selected-videos', function(){
	$("#videos-selected").empty();
	$("#videos-selected").append('<label class= "control-label col-sm-2 "> Videos attached</label>');
	$('input[name^="playlist_videos"]').each(function(){
		if($(this).is(":checked")){
			$("#videos-selected").append('<div class="selected-videos col-sm-10 col-sm-offset-2" data-videoid='+ $(this).val() +'>'+$(this).attr("data-videoname")+'</div>')
		}
	});
});


$(document).on('click','.playlist-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var banner_id = $("input[name='banner_id']").val();
	var playlist_videos = [];

	$(".selected-videos").each(function(){
		playlist_videos.push($(this).attr('data-videoid'));
	});

	console.log('title: ' + title);
	console.log(playlist_videos);
	
    if(hasError == false) {

		$.ajax({
		    url: '/admin/playlist',
		    type: 'POST',
		    data: {
		  		banner_id : banner_id,
		  		title : title,
		  		playlist_videos : playlist_videos
		  		
		    },
		    success: function(result) {
		        console.log(result);
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
			        
		        }
		        else{
		        	$('#createNewPlaylistForm')[0].reset(); // empty the form
		        	swal({
		        		title : 'Nice!',
		        		text : title + " has been created",
		        		type : 'success',

		        	},
		        	function(){
		        		window.location.reload();
		        	})
					// swal("Nice!", "'" + subject +"' has been created", "success");        
		        }
		        
		    }
		}).done(function(response){
			
		});    	
    }


    return false;
});
