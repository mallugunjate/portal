$(document).ready(function(){

	console.log('selected banner : ' + localStorage.getItem('admin-banner'));
	$(".navbar-brand").find('span').text(localStorage.getItem("admin-banner"));
	
	$(".banner-switch").click(function(){
		
		localStorage.setItem('admin-banner-id', $(this).attr('data-banner-id'));
		localStorage.setItem('admin-banner', $(this).text());
		console.log("banner_id : " + localStorage.getItem("admin-banner-id"));
		console.log("banner : " + localStorage.getItem("admin-banner"));
		$(".navbar-brand").find('span').text(localStorage.getItem("admin-banner"));

	})
});