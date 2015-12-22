	var showPackage = function(docPackage){
		
		$("#package-viewer").removeClass('hidden').addClass('visible');
		$("#empty-container").removeClass('visible').addClass('hidden');
		$("#file-container").removeClass('visible').addClass('hidden');
		$("#file-uploader").removeClass('visible').addClass('hidden');

		$("#package-viewer #package-name").empty();
		$("#package-viewer #package-details").empty();
		$("#package-viewer #package-name").append(	'<div class="package-title">' + docPackage.package.package_screen_name + '</div>' +
													'<div class="package-timestamp"> Last Updated : ' + docPackage.package.updated_at + '</div>');
										
		$("#edit-package").attr('href', '/admin/package/'+ docPackage.package.id +'/edit');
		$("#delete-package").attr('data-package-id', docPackage.package.id);
		$("#package-viewer #package-details").append('<div class="package-details-title"> Files Included </div>')
		_.each(docPackage.documentDetails, function(index){
			$("#package-viewer #package-details").append('<div class="package-files">' +
														'<div class="package-filename"> ' + index.original_filename + '</div>' +
														'<div class="package-filepath"> File Location : ' + index.folder_path + '</div>' +
														'<div class="package-timestamp"> Uploaded At : ' + index.created_at + '</div>' +
														'</div>'
														);
		});
	}
