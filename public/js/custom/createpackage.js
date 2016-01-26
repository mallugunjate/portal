$(document).ready(function(){

	formatDate();
	$('#attach-selected-files').on('click', function(){
		$("#files-selected").append('<p>Files attached :</p>');
		$('input[name^="package_files"]').each(function(){
			if($(this).is(":checked")){
				$("#files-selected").append('<ul class="selected-files" data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
			}
		});
	});

	$(".chosen").chosen({
		width:'50%'
	});

});



$("#add-more-files").on('click', function(){
	$("#document-listing").modal('show');
})

$(".remove-file").on('click', function(){
	var document_id = $(this).attr('data-document-id');
	$(this).parent().fadeOut(200);
	$("#files-staged-to-remove").append('<input name=remove_document[] value='+ document_id +'>')
});



$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});


$("#add-folders").click(function(){
	$("#folder-listing").modal('show');
});

var formatDate = function(){
	
	if ( typeof(start) === "number") {
		var offset = new Date().getTimezoneOffset();
		var offsetSeconds = offset*60;
		var startTime = moment.unix(start + offsetSeconds).format('YYYY-MM-DD HH:mm:ss');
		var endTime = moment.unix(end + offsetSeconds ).format('YYYY-MM-DD HH:mm:ss');
		$("input[name='start']").val(startTime);
		$("input[name='end']").val(endTime);			
	}
	
}