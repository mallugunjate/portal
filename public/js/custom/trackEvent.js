$("body").on("click", ".trackclick", function(e){
// $( "[data-res-id]" ).live( "click", function () {
	var pathArray = window.location.pathname.split( '/' );
	console.log('clicked something...');

	loc = pathArray[2];
	loc_id = pathArray[4];

	if(typeof section == "undefined"){
		loc = "dashboard";
	}

	if(typeof sectionId == "undefined"){
		loc_id = 0;
	}

	trackEvent( $(this).attr("data-res-id"), localStorage.getItem('userStoreNumber'), loc, loc_id );

});

function trackEvent( store, resource, location, location_id)
{

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