$("body").on("click", ".trackclick", function(e){
// $( "[data-res-id]" ).live( "click", function () {
	var pathArray = window.location.pathname.split( '/' );
	console.log('clicked something...');

	fileId = $(this).attr("data-res-id");
	commId = $(this).attr("data-comm-id");
	urgentnoticeId = $(this).attr("data-urgentnotice-id");
	externalUrlId = $(this).attr("data-ext-url");
	
	loc = pathArray[2];
	loc_id = pathArray[4];

	if(typeof loc == "undefined"){
		loc = "dashboard";
	}

	if(typeof loc_id == "undefined"){
		loc_id = 0;
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

	trackEvent( "file", fileId, localStorage.getItem('userStoreNumber'), loc, loc_id );

});

function trackEvent( type, store, resource, location, location_id)
{

	console.log('%c tracked the click! ' + type + ', ' + store + ', ' + resource +', ' + loc + ', ' + loc_id + ' ', 'background: #222; color: #bada55; padding: 5px;');

	// $.ajax({
	//     url: '/bugreport',
	//     type: 'POST',
	//     data: {
	//   		banner: banner,
	//   		store_number: store_number,
	//   		user: user,
	//   		current_url: current_url,
	//   		description: description,
	//   		user_email: user_email,
	//   		follow_up: follow_up 		
	//     },
	//     success: function(result) {
	         
	//     }
	// }).done(function(response){


	// }); 

	//});	


}