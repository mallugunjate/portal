var banner_id = $('#banner_id').val();

$("body").on("click", ".fileinput-upload-button", function(e) {

	event.stopPropagation(); 
	event.preventDefault(); 

	var file = $('input[id="dashboardbackground"]')[0].files[0];

    var data = new FormData();
        
		data.append("banner_id", banner_id);        
        data.append('background', file);
        
        $.ajax({
            url: '/admin/dashboardbackground',
            type: 'POST',
            data: data, 
			processData: false,
			contentType: false,
            success: function(result) {
                
                swal("Nice!", "'" + file.name +"' has been uploaded", "success");   
                $('.fileinput-remove').trigger( "click" ); //reset the form 
                
				$.get( "/admin/dashboardbackground/"+banner_id, { },
              		function(data) {
                 		$("#background-preview").attr("src", "/images/dashboard-banners/"+data);
              		}
           		);   
            }
            
        });        
});


