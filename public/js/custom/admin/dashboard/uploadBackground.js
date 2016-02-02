// var files;
// $('input[type=file]').on('change', prepareUpload);

var banner_id = $('#banner_id').val();

// function prepareUpload(event)
// {
//   files = event.target.files;
// }

$("body").on("click", ".fileinput-upload-button", function(e) {

	event.stopPropagation(); 
	event.preventDefault(); 

	var file = $('input[id="dashboardbackground"]')[0].files[0];
	console.log(file.name);
	var data = new FormData();
	
	data.append("filename", file.name);
    data.append("banner_id", banner_id);

    console.log(data);
	$.ajax({
	        url: '/admin/dashboardbackground/' + banner_id,
	        type: 'POST',
	        data: data,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	            if(typeof data.error === 'undefined')
	            {
	                // Success so call function to process the form
	                //submitForm(event, data);
	                console.log(data);
	            }
	            else
	            {
	                // Handle errors here
	                console.log('data error ERRORS: ' + data.error);
	            }
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	            // Handle errors here
	            console.log('jqXHR ERRORS: ' + textStatus);
	            // STOP LOADING SPINNER
	        }
	    });

	// console.log("file delete requested");
	// e.preventDefault();
	// if (confirm('Are you sure you want to delete this file?')) {
	//     $(this).closest('tr').fadeOut(500);
	// 	$.ajax({
	// 	    url: '/admin/document/'+ this.id,
	// 	    type: 'DELETE',
	// 	    data : {	
	// 	    			_token : $('[name=_token').val()
	// 			   }

	// 	})
	// 	.done(function(data) {
	// 		console.log(data);
	// 	});
	// } 
});

