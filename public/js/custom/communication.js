$(document).ready(function(){
	$('#attach-selected-packages').on('click', function(){
		console.log("hello");
		$("#packages-selected").append('<p>Packages Attached:</p>');
		$('input[name^="packages"]').each(function(){			
			if($(this).is(":checked")){
				$("#packages-selected").append('<ul class="selected-packages" data-package-id='+ $(this).val() +'>'+$(this).attr("data-package-name")+'</ul>')
			}
		});

		
	});
});