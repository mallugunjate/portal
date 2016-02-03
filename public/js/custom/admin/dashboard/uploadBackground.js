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
	// data.append("filename", file.name);
 //    data.append("banner_id", banner_id);

    var data = new FormData();
        
		data.append("banner_id", banner_id);        
        data.append('background', file);
        
        $.ajax({
            url: '/admin/dashboardbackground',
            type: 'POST',
            data: data, 
           processData: false,  // tell jQuery not to process the data
           contentType: false,   // tell jQuery not to set contentType
            success: function(result) {
                console.log(result);
                //$('#createNewFeatureForm')[0].reset(); // empty the form
                swal("Nice!", "'" + file.name +"' has been uploaded", "success");        
            }
        }).done(function(response){
            console.log(response);
        });        
   });


 //    console.log(data);
	// $.ajax({
	//         url: '/admin/dashboardbackground/',
	//         type: 'POST',
	//         data: data,
	//         cache: false,
	//         // dataType: 'json',
	//         processData: false, // Don't process the files
	//         contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	//         success: function(data, textStatus, jqXHR)
	//         {
	//             if(typeof data.error === 'undefined')
	//             {
	//                 // Success so call function to process the form
	//                 //submitForm(event, data);
	//                 console.log(data);
	//             }
	//             else
	//             {
	//                 // Handle errors here
	//                 console.log('data error ERRORS: ' + data.error);
	//             }
	//         },
	//         error: function(jqXHR, textStatus, errorThrown)
	//         {
	//             // Handle errors here
	//             console.log('jqXHR ERRORS: ' + textStatus);
	//             // STOP LOADING SPINNER
	//         }
	//     });




