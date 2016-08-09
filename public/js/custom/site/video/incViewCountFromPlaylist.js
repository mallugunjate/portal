jQuery(document).on('click', 'video', function(){
        if (this.paused) {
            this.play();
        } else {
            this.pause();
        }
});

var videosPlayedThisSession = [];

$(document).ready(function() {
    $(".videoInPlaylist").click(function(event) {

        var videoid = event.target.id;
        videoid = videoid.replace("video", "");

        var inArray = $.inArray( videoid, videosPlayedThisSession);
        console.log("in array?: " + inArray);

        if(inArray == -1){
            console.log("first time played this session. added to array");
            console.log(videosPlayedThisSession);
            videosPlayedThisSession.push(videoid);

            $.ajax({
            	url : "/videocount/" + videoid,
                type: 'PATCH',
                data: {
                	id: videoid,
                },
            }).done(function( data ){
                console.log( '!!!  ' + videoid + ' has been tracked');
            });

        } else {
            console.log("video " + videoid + " has been played already. this is a play/pause.")
        }




    });
});
