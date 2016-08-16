$( document ).ready(function() {

	var videoid = $("#video_id").val();
	$.ajax({
		url : "/videocount/" + videoid,
	    type: 'PATCH',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){
		console.log(data);
	});
});
