$(document).ready(function(){
	
	formatDate();
	$('#attach-selected-packages').on('click', function(){
		$("#packages-selected").append('<p>Packages Attached:</p>');
		$('input[name^="packages"]').each(function(){			
			if($(this).is(":checked")){
				$("#packages-selected").append('<ul class="selected-packages" data-package-id='+ $(this).val() +'>'+$(this).attr("data-package-name")+'</ul>')
			}
		});
	});

	$('#attach-selected-files').on('click', function(){
		$("#files-selected").append('<p>Files attached :</p>');
		$('input[name^="package_files"]').each(function(){
			if($(this).is(":checked")){
				$("#files-selected").append('<ul class="selected-files" data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
			}
		});
	});

	$(".chosen").chosen({
		width:"50%",
	});
});

$(".remove-document").on('click', function(){
	var document_id = $(this).attr('data-document-id');
	$(this).parent().fadeOut(200);
	$("#documents-staged-to-remove").append('<input name=remove_document[] value='+ document_id +'>');

});

$(".remove-package").on('click', function(){
	var package_id = $(this).attr('data-package-id');
	$(this).parent().fadeOut(200);
	$("#packages-staged-to-remove").append('<input name=remove_package[] value='+ package_id +'>');

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

$(".delete-communication").click(function(){
	console.log($('[name="_token"]').val());
	if (confirm('Are you sure you want to delete this package?')) {
	    
		$.ajax({
		    url: '/admin/communication/'+ this.id,
		    type: 'DELETE',
		    data : {	
		    			_token : $('[name="_token"]').val(),
		    			banner_id : $('[name="banner_id"]').val()
				   }

		})
		.done(function(data) {
			console.log(data);
			var banner_id = $("input[name='banner_id']").val();
			window.location = '/admin/home?banner_id=' + banner_id;
		});
	} 

});