function trackEvent( t )
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
	console.log('%c tracked the click!' + t.attr('data-resource-id') + ' ', 'background: #222; color: #bada55');
	//console.log('%c tracked the click!', 'background: #222; color: #bada55');
	console.log(t);
}