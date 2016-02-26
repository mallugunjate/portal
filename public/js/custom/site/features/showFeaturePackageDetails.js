$(".feature_package").on('click', function(){

	var packageId = $(this).attr('data-packageId');
	showPackageDocuments(packageId);
	showPackageFolders(packageId);

});

var showPackageDocuments = function(packageId) {
	$(".package-document-listing").addClass('hidden');
	$(".package-document-listing[data-packageid = " + packageId+"]").removeClass('hidden').addClass('visible');
}

var showPackageFolders = function(packageId) {
	$(".package-folder-listing").addClass('hidden');
	$(".package-folder-listing[data-packageid = " + packageId+ "]").removeClass('hidden').addClass('visible');
}

var getFolderDocuments = function(global_folder_id, packageId) {
	$.ajax(
		{
			url : '/folder/' + global_folder_id
		}
	)
	.done(function(data){
		console.log(data);
		_.each(data.files, function(i){
			$(".package-folder-document-listing[data-packageid= " + packageId + "]").empty().append( i.link_with_icon );
		});
		$(".package-folder-document-listing[data-packageid= " + packageId + "]").removeClass('hidden');
		$(".package-document-listing[data-packageid= " + packageId + "]").addClass('hidden');
	});
}

$(".folder-item").on('click', function(e){
	e.stopPropagation(e);
	console.log($(e.target).find('i.indicator').first());
	$(e.target).find('i.indicator').first().addClass('fa-folder-open');
	var global_folder_id = $(this).attr('id');
	var packageid = $(this).closest('.package-folder-listing').attr('data-packageid')
	getFolderDocuments(global_folder_id, packageid);
});

$("body").on("click", ".launchPDFViewer", function(e){
	var filepath = $(this).attr("data-file");
	$("#fileviewmodal").find('iframe').attr("src", filepath);
});