$(document).ready(function(){

	$('#add-files').on('click', function(){
		console.log("1");
		$('input[name^="package_files"]').each(function(){
			if($(this).is(":checked")){
				$("#files").append('<ul class="selected-files" data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
			}
		});
		
	});

	$("#create-package").on("click", function(){
		var document_ids = [];
		var counter = 0;
		$(".selected-files").each(function(){
			
			document_ids[counter] = $(this).attr("data-fileid");
			counter++;

		});
		
		$.ajax({
			method : "POST",
			url : "/admin/package",
			data : { "_token" : $('[name="_token"]').val(), "documents" : document_ids },
		}).done(function( data ){
			console.log(data);
		});
	});
})