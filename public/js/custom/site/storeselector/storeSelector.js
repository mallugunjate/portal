$( document ).ready(function() {

	$("#storeswitch").click(function() {
		resetStore();
		return;
	});
	
	if( !!localStorage.getItem('userStoreNumber') && window.location.pathname == "/" ) {
		// console.log( "null check: " + localStorage.getItem('userStoreNumber') );
		window.location="/dashboard";
	}

	// console.log("check state of banner/store....");
	// console.log("Banner: " + localStorage.getItem('userBanner') );
	// console.log("Store: " + localStorage.getItem('userStoreNumber') );
	// console.log("Name: " + localStorage.getItem('userStoreName') );

	var bannerDropdown = document.getElementById('bannerSelect');
	var storeDropdown = document.getElementById('storeSelect');


	if( document.contains(bannerDropdown) ){

		getBanners();

		bannerDropdown.onchange = function() {
			localStorage.setItem('userBanner', bannerDropdown.options[bannerDropdown.selectedIndex].value);
			// console.log("set the userBanner = " + localStorage.getItem('userBanner') );		
			getStores( localStorage.getItem('userBanner') );
		}
		storeDropdown.onchange = function() {
			localStorage.setItem('userStoreNumber', storeDropdown.options[storeDropdown.selectedIndex].value);
			localStorage.setItem('userStoreName', storeDropdown.options[storeDropdown.selectedIndex].text);
			// console.log("set the userStoreNumber = " + localStorage.getItem('userStoreNumber') );
			// console.log("set the userStoreName = " + localStorage.getItem('userStoreName') );
			window.location="/dashboard";
		}	
	}

});

var getBanners = function()
{
    var jqxhr = $.getJSON( STORE_API_DOMAIN + "/banners", function(json) {
 
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
	var jqxhr = $.getJSON( STORE_API_DOMAIN + "/banner/" + banner, function(json) {
 
    var i=0;
        $.each(json, function(index, element) {
            $("#storeSelect").append("<option value='"+ element.store_number +"'>"+ element.store_number + " " + element.name +"</option>");
            i++;
        });
    })
}

var resetStore = function()
{
	// console.log("-------- Before --------");
	// console.log("Banner: " + localStorage.getItem('userBanner') );
	// console.log("Store: " + localStorage.getItem('userStoreNumber') );
	// console.log("Name: " + localStorage.getItem('userStoreName') );

	localStorage.removeItem('userBanner');
	localStorage.removeItem('userStoreNumber');
	localStorage.removeItem('userStoreName');

	// console.log("-------- After --------");	
	// console.log("Banner: " + localStorage.getItem('userBanner') );
	// console.log("Store: " + localStorage.getItem('userStoreNumber') );
	// console.log("Name: " + localStorage.getItem('userStoreName') );

	window.location="/";
}