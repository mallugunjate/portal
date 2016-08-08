$( "#videolike" ).on( "click", function() {

	var videoid = $("#video_id").val();
	$.ajax({
		url : "/videolike/" + videoid,
	    type: 'PATCH',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){
		console.log(data);

        $("#videolike").removeClass('btn-outline');

        // $("#videolike").removeClass('dim');
        // $("#videodislike").removeClass('dim');
        $( "#videolike" ).html( '<i class="fa fa-thumbs-up"></i> ' + data );

        $( "#videodislike" ).unbind();
        $( "#videolike" ).unbind();

        $("#videodislike").disable(true);

        $("#videodislike").removeClass('btn-danger');
        $("#videodislike").addClass('btn-default');


        // $("#videolike").disable(true);
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
		// $("#videodislike").disable(true);
        // $("#videolike").disable(true);
        $("#videodislike").removeClass('btn-outline');
        // $("#videodislike").removeClass('dim');
        // $("#videolike").removeClass('dim');
        $( "#videodislike" ).html( '<i class="fa fa-thumbs-down"></i> ' + data );

        $( "#videodislike" ).unbind();
        $( "#videolike" ).unbind();

        $("#videolike").disable(true);

        $("#videolike").removeClass('btn-primary');
        $("#videolike").addClass('btn-default');

        // $("#videodislike").disable(true);

	});
});


jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            this.disabled = state;
        });
    }
});
