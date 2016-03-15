$(".feature_package").on('click', function(){

	var packageId = $(this).attr('data-packageId');
	
	$(".package-name").find('i').removeClass('fa-folder-open').addClass('fa-folder');
	$(this).find(".package-name").find('i').removeClass('fa-folder').addClass('fa-folder-open');

	$(".package-folder-document-listing").find(".folder-name").find("h3").empty();
	$(".package-folder-documents").empty();
	showPackageDocuments(packageId);
	showPackageFolders(packageId);	
	

});

var showPackageDocuments = function(packageId) {
	$(".single-package-document-container").addClass('hidden');
	$(".single-package-document-container[data-packageid = " + packageId+"]").removeClass('hidden').addClass('visible');
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
		var package_folder_name = $(".package-folder-document-listing[data-packageid= " + packageId + "]").find(".folder-name").find("h3")
		package_folder_name.empty().append("<i class='fa fa-folder-open-o'></i> " + data.folder.name)
		$(".package-folder-documents[data-packageid= " + packageId + "]").empty();
		_.each(data.files, function(i){
			$(".package-folder-documents[data-packageid= " + packageId + "]").append("<div>" + i.link_with_icon + "</div>" );
		});
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