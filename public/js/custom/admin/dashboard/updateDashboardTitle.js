$("#cancel-dashboard-title-update").on('click', function(){
	
	var dashboard_title = $("#dashboard_title").val();
	var dashboard_subtitle = $("#dashboard_subtitle").val();

	$('input[name="dashboard_title"]').val(dashboard_title);
	$('input[name="dashboard_subtitle"]').val(dashboard_subtitle);

});

$(".update-dashboard").on('click', function(){
	
	var hasError = false;
	var banner_id = $("#banner_id").val();
	var dashboard_title  = $('input[name="dashboard_title"]').val();
	var dashboard_subtitle  = $('input[name="dashboard_subtitle"]').val();
	var request_type = 'updateTitle'
	

	//if(dashboard_title == '' || dashboard_subtitle == '') {
	if(dashboard_title == '') {		
		swal("Oops!", "Oops! We need a Title for the Dashboard.", "error"); 
		hasError = true;
	}


	if(hasError == false) {
		$.ajax({
		    url: '/admin/dashboard/' + banner_id,
		    type: 'PATCH',
		    data: { title : dashboard_title, subtitle: dashboard_subtitle, request_type : request_type},
		    dataType: 'json',
		    success: function(result) {
		        
		        console.log(result); 
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("input[name='dashboard_title']").parent().parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
		        }
		        else{
		        	$("#dashboard_title").val(result.title);
		        	$("#dashboard_subtitle").val(result.subtitle);
					swal("Nice!", "Dashboard updated", "success");	
		        }

		        

		    }
		}).done(function(response){
			console.log(response);
		});  
	}	
});

