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

var getFolderDocuments = function(global_folder_id) {
	$.ajax(
		{
			url : '/admin/document',
			data : {
						folder : global_folder_id,
						isWeekFolder : $(this).attr("data-isweek")
				   }
		}
	)
	.done(function(data){
		console.log(data);
		// fillTable(data);
		// console.log("this is what we are sending to setDeepLink " + data.folder.global_folder_id);
		// setDeepLink(data.folder.global_folder_id);
		// fillBreadCrumbs(data);
		// $("#folder-name-for-upload").html("to  <i>"+data.folder.name+"</i>");
		// $("#folder_id").val(data.folder.global_folder_id);

	});
}

$(".folder-item").on('click', function(){
	var global_folder_id = $(this).attr('id');
	getFolderDocuments(global_folder_id)
});