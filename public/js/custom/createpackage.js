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
		var package_name = $('input[name="package_name"]').val();
		var banner_id = $('input[name="banner_id"]').val();
		console.log("banner_id : " +banner_id);
		var counter = 0;
		$(".selected-files").each(function(){
			
			document_ids[counter] = $(this).attr("data-fileid");
			counter++;

		});
		
		$.ajax({
			method : "POST",
			url : "/admin/package",
			data : { "_token" : $('[name="_token"]').val(), "documents" : document_ids, "package_name" :  package_name, 'banner_id' : banner_id},
		}).done(function( data ){
			console.log(data);
			window.location = '/admin/home?banner_id=' + banner_id;
		});
	});
})