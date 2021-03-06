$("#quicklink-document").click(function(){
	$("#document-listing").modal('show');
});

$("#quicklink-folder").click(function(){
	$("#folder-listing").modal('show');
});

$("#quicklink-external").click(function(){
	$("#external").modal('show');
});


 $(".folder-checkbox").on('click', function(){
 	$(".folder-checkbox").prop("checked", false);
 	$(this).prop("checked", true);
 });

 $(".document-checkbox").on('click', function(){
 	$(".document-checkbox").prop("checked", false);
 	$(this).prop("checked", true);
 });


$('#attach-selected-files').on('click', function(){
	$("#quicklink-url").empty();

	var selectedFile = $("#ql-doc-selected").html();
	var selectedFileId = $("input[id=selected_file_id]").val();

	console.log("selected file: " + selectedFile + ", file id: " + selectedFileId );

	$('#document-listing').modal('toggle');

	$("#quicklink-url").html(selectedFile);
	$("input[id=url]").val(selectedFileId);
	$("#url").data('url', selectedFileId);
	// $('.document-checkbox').each(function(){
	// 	if($(this).is(":checked")){
	// 		//$("#quicklink-url").append('<div class="selected-files" id="url" data-url='+ $(this).val() +'>'+$(this).attr("data-filename")+'</div>')
	// 	}
	// });
});

$("#add-external-url").on('click', function(){
	$("#quicklink-url").empty();
	$("#quicklink-url").append('<div id="url" value="'+ $("#external-url").val() +'" data-url="'+ $("#external-url").val() +'"> '+$("#external-url").val()+' </div>')
	$('#external').modal('toggle');
});

$('#attach-selected-folders').on('click', function(){

	$("#quicklink-url").empty();
	
	$('.folder-checkbox').each(function(){
		if($(this).is(":checked")){
			$("#quicklink-url").append('<div class="selected-folders" id="url" value="'+ $(this).attr('data-folderid') +'" data-url='+ $(this).attr('data-folderid') +'>'+$(this).attr("data-foldername")+'</div>')
		}
	});
	console.log( $("#url").val());
	$("#folder-listing").modal('toggle');
		
});

$(document).on('click','.quicklink-create',function(){
  	
  	var hasError = false;
 
 	var banner_id = $("input[name='banner_id']").val();
	var name = $("#name").val();
	var type = $('input[name="link-type"]:checked').val();
	var url = $("#url").data('url');
	console.log("name : " + name);
	console.log("url : " + url);
	console.log("type : " + type);
	console.log('banner_id : ' + banner_id);


    if(name == '') {
		swal("Oops!", "This quicklink needs a name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/quicklink',
		    type: 'POST',
		    data: {
		  		name: name,
		  		type: type,
		  		url:  url,
		  		banner_id : banner_id
		    },
		    success: function(result) {
		        console.log(result);
		        // $('#createNewQuicklinkForm')[0].reset(); // empty the form
				swal("Nice!", "'" + name + "' has been created", "success");        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});