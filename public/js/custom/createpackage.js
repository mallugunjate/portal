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

	$('#attach-selected-folders').on('click', function(){

		$("#folders-selected").empty();
		$("#folders-selected").append('<p>Folders attached :</p>');
		$('input[name^="package_folders"]').each(function(){


			var attr = $(this).attr('data-folderRoot');

			// For some browsers, `attr` is undefined; for others,
			// `attr` is false.  Check for both.
			if (typeof attr !== typeof undefined && attr !== false) {
			    
			    $("#folders-selected").append('<ul class="selected-folders" data-folderid='+ $(this).attr('data-folderid') +'>'+$(this).attr("data-foldername")+'</ul>')
			}
			
		});
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
$(".folder-checkbox").on('click', function(){
	if($(this).is(":checked")){
		$(this).attr('data-folderRoot', 'true')
		 $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked)
            .attr("disabled", true);

	}else{
		$(this).removeAttr('data-folderRoot')
	    $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', false)
            .attr("disabled", false);
	}	
});
