$( document ).ready(function() {

	$("#storeswitch").click(function() {
		resetStore();
		return;
	});
	
	if( !!localStorage.getItem('userStoreNumber') && window.location.pathname == "/" ) {
		window.location="/" + localStorage.getItem('userStoreNumber');
	}

	if( localStorage.getItem('userStoreNumber') == null && window.location.pathname != "/" ) {
		window.location="/";
	}		

	var bannerDropdown = document.getElementById('bannerSelect');
	var storeDropdown = document.getElementById('storeSelect');

	if( document.contains(bannerDropdown) ){

		getBanners();

		bannerDropdown.onchange = function() {
			localStorage.setItem('userBanner', bannerDropdown.options[bannerDropdown.selectedIndex].value);	
			getStores( localStorage.getItem('userBanner') );
		}
		storeDropdown.onchange = function() {
			localStorage.setItem('userStoreNumber', storeDropdown.options[storeDropdown.selectedIndex].value);
			localStorage.setItem('userStoreName', storeDropdown.options[storeDropdown.selectedIndex].text);
			window.location="/" + localStorage.getItem('userStoreNumber');
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
	localStorage.removeItem('userBanner');
	localStorage.removeItem('userStoreNumber');
	localStorage.removeItem('userStoreName');

	window.location="/";
}