const API_DOMAIN = "http://localhost:8888";

$( document ).ready(function() {

	// if( localStorage.getItem('userBanner') && localStorage.getItem('userStoreNumber') ) {
	// //	window.location="/dashboard";
	// } else {
		console.log("check state of banner/store....");
		console.log("Banner: " + localStorage.getItem('userBanner') );
		console.log("Store: " + localStorage.getItem('userStoreNumber') );

		getBanners();

		var bannerDropdown = document.getElementById('bannerSelect');
		var storeDropdown = document.getElementById('storeSelect');

		bannerDropdown.onchange = function() {
			localStorage.setItem('userBanner', bannerDropdown.options[bannerDropdown.selectedIndex].value);
			console.log("set the userBanner = " + localStorage.getItem('userBanner') );		
			getStores( localStorage.getItem('userBanner') );
		}
		storeDropdown.onchange = function() {
			localStorage.setItem('userStoreNumber', storeDropdown.options[storeDropdown.selectedIndex].value);
			console.log("set the userStoreNumber = " + localStorage.getItem('userStoreNumber') );
//			window.location="/dashboard";
			alert("we're off!");
		}	


	// }	
});

var getBanners = function()
{
    var jqxhr = $.getJSON( API_DOMAIN + "/banners", function(json) {
 
    var i=0;
        $.each(json, function(index, element) {
            $("#bannerSelect").append("<option value='"+ element.id +"'>"+ element.name +"</option>");
            i++;
        });
    })
}

var getStores = function(banner)
{
	$("#storeSelect").empty();	
	$("#storeSelect").append("<option></option>");
	var jqxhr = $.getJSON( API_DOMAIN + "/banner/" + banner, function(json) {
 
    var i=0;
        $.each(json, function(index, element) {
            $("#storeSelect").append("<option value='"+ element.store_number +"'>"+ element.store_number + " " + element.name +"</option>");
            i++;
        });
    })
}