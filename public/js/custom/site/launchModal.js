$("body").on("click", ".launchPDFViewer", function(e){
	var filepath = $(this).attr("data-file");
	$("#fileviewmodal").find('iframe').attr("src", filepath);
});

$("body").on("click", ".launchVideoViewer", function(e){
	var filepath = $(this).attr("data-file");
	$("#videomodal").find('iframe').attr("src", "/video.php?v="+filepath);
	$('#videomodal').modal('show');

	$("#videomodal").find('iframe').css({backgroundColor: 'transparent'});
});

$('body').on('hidden.bs.modal', function () {
   $('iframe').attr('src', $('iframe').attr('src'));
});