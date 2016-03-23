$("body").on("click", ".trackclick", function(e){
// $( "[data-res-id]" ).live( "click", function () {
	var pathArray = window.location.pathname.split( '/' );
	console.log('clicked something...');

	commId = $(this).attr("data-comm-id");
	//communication 
	if(typeof commId != "undefined" ){

		trackEvent( "comm", $(this).attr("data-res-id"), localStorage.getItem('userStoreNumber'), loc, loc_id );

	} else {

		loc = pathArray[2];
		loc_id = pathArray[4];

		if(typeof loc == "undefined"){
			loc = "dashboard";
		}

		if(typeof loc_id == "undefined"){
			loc_id = 0;
		}

		trackEvent( "file", $(this).attr("data-res-id"), localStorage.getItem('userStoreNumber'), loc, loc_id );

	}
	



});

function trackEvent( type, store, resource, location, location_id)
{


	switch(type){

		case "file":
			console.log('%c tracked the click! ' + store + ', ' + resource +', ' + loc + ', ' + loc_id + ' ', 'background: #222; color: #bada55');
			break;

		case "comm":

			break;

	}
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
	console.log('%c tracked the click! ' + store + ', ' + resource +', ' + loc + ', ' + loc_id + ' ', 'background: #222; color: #bada55');

}