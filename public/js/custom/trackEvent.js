$("body").on("click", ".trackclick", function(e){
// $( "[data-res-id]" ).live( "click", function () {
	var pathArray = window.location.pathname.split( '/' );
	console.log('clicked something...');

	section = pathArray[2];
	sectionId = pathArray[4];

	if(typeof section == "undefined"){
		section = "dashboard";
	}

	if(typeof sectionId == "undefined"){
		sectionId = 0;
	}

	trackEvent( $(this).attr("data-res-id"), localStorage.getItem('userStoreNumber'), section, sectionId );

});

function trackEvent( t, store, p, i)
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
	console.log('%c tracked the click! ' + t + ', ' + store +', ' + p + ', ' + i + ' ', 'background: #222; color: #bada55');
	//console.log('%c tracked the click!', 'background: #222; color: #bada55');
	console.log(t);
}