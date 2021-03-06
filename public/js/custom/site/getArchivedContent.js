$(document).ready(function(){

	console.log(localStorage.getItem('archives'));
	if(localStorage.getItem('archives')) {
		$("input[name='archives']").prop('checked', true);
	}
})

$(".archive-onoffswitch").on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function(){
//$("#archives").on('change', function(){

	if($("input[name='archives']:checked").val()) {

		localStorage.setItem('archives', true);
		var query = window.location.search;
		
		if(query.length>0) { //has query param
			window.location = window.location.href + "&archives=true"	
		}
		else{
			if (window.location.hash) { //no query present but has Hash
					
				var parentfolder = $("#folder-title").attr('data-folderid');
				$(".folder#"+parentfolder).click();
				// window.location = window.location.pathname + "?archives=true" + window.location.hash;
			}
			else{
				if(window.location.pathname != "/" + localStorage.getItem('userStoreNumber') + "/document") {
					window.location = window.location.href + "?archives=true"		
				}
				
			}
			
		}
		
	}
	else{

		localStorage.removeItem('archives');
		var url = window.location.href;
		
		if(url.match("&archives")){ //has query param other than archives=true
			window.location = window.location.href.substring(0, url.match("&archives").index );		
		}
		else{
			if (window.location.hash){
				var parentfolder = $("#folder-title").attr('data-folderid');
				$(".folder#"+parentfolder).click();
			}
			else{
				window.location = window.location.pathname;	
			}
			
		}
		
	}
});

