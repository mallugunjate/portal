$(document).on('click','.eventtype-create',function(){
  	
  	var hasError = false;

    var communicationTypeName = $("#communication_type").val();
    var bannerId = localStorage.getItem('admin-banner-id');

    console.log(communicationTypeName +", "+ bannerId);

    if(communicationTypeName == '') {
		swal("Oops!", "This we need a name for this communication type.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}	

	if(hasError == false) {
		$.ajax({
		    url: '/admin/communicationtypes',
		    type: 'POST',
		    data: { communication_type: communicationTypeName, banner_id: bannerId },
		    success: function(result) {
		        $("#event_type").val(""); // empty the form
				swal("Nice!", "'" + communicationTypeName +"' has been created", "success");        
		    }
		});
	}
	
    return false;
});