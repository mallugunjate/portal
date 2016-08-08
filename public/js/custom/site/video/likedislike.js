$( "#videolike" ).on( "click", function() {

	var videoid = $("#video_id").val();
	$.ajax({
		url : "/videolike/" + videoid,
	    type: 'PATCH',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){

        $("#videolike").removeClass('btn-outline');
        $( "#videolike" ).html( '<i class="fa fa-thumbs-up"></i> ' + data );

        $( "#videodislike" ).unbind();
        $( "#videolike" ).unbind();

        $("#videodislike").disable(true);

        $("#videodislike").removeClass('btn-danger');
        $("#videodislike").addClass('btn-default');
	});
});


$( "#videodislike" ).on( "click", function() {

	var videoid = $("#video_id").val();
	$.ajax({
		url : "/videodislike/" + videoid,
	    type: 'PATCH',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){

        $("#videodislike").removeClass('btn-outline');
        $( "#videodislike" ).html( '<i class="fa fa-thumbs-down"></i> ' + data );

        $( "#videodislike" ).unbind();
        $( "#videolike" ).unbind();

        $("#videolike").disable(true);

        $("#videolike").removeClass('btn-primary');
        $("#videolike").addClass('btn-default');
	});
});


jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            this.disabled = state;
        });
    }
});
