$("body").on("click", ".trackclick", function(e){
// $( "[data-res-id]" ).live( "click", function () {
	var pathArray = window.location.pathname.split( '/' );

	fileId = $(this).attr("data-res-id");
	videoId = $(this).attr("data-video-id");
	commId = $(this).attr("data-comm-id");
	urgentnoticeId = $(this).attr("data-urgentnotice-id");
	externalUrlId = $(this).attr("data-ext-url");
	playListId = $(this).attr("data-playlist-id");

	loc = pathArray[2];
	loc_id = pathArray[4];

	if(typeof loc == "undefined"){
		loc = "dashboard";
	}

	if(typeof loc_id == "undefined"){
		loc_id = 0;
	}

	if( loc == "document"){
		loc = "library";
	}

	//communication
	if(typeof commId != "undefined" ){
		trackEvent( "communication", commId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	//urgent notice
	if(typeof urgentnoticeId != "undefined" ){
		trackEvent( "urgentnotice", urgentnoticeId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	//external url
	if(typeof externalUrlId != "undefined"){
		trackEvent( "external_url", externalUrlId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	//play list
	if(typeof playListId != "undefined"){
		trackEvent( "playlist", playListId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	if(typeof videoId != "undefined"){
		trackEvent( "video", videoId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	trackEvent( "file", fileId, localStorage.getItem('userStoreNumber'), loc, loc_id );

});

function trackEvent( type, resource, store, location, location_id)
{

	console.log('%c tracked the click! ' + type + ', ' + resource + ', ' +  store +', ' + loc + ', ' + loc_id + ' ', 'background: #222; color: #bada55; padding: 5px;');

	$.ajax({
	    url: '/clicktrack',
	    type: 'POST',
	    data: {
	  		type: type,
	  		resource_id: resource,
	  		store_number: store,
	  		location: loc,
	  		location_id: loc_id
	    },
	    success: function(result) {
	      console.log('click as been tracked');
	    }

	});
	// .done(function(response){


	// });




}
