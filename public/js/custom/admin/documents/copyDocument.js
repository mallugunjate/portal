$(document).on("click", "#copy-document", function() {
		console.log('are we here?');
		var documentId = $(this).attr('data-fileid');
		var documentName = $(this).attr('data-documentName');
		// var documentFolderPath = $(this).attr('data-documentFolderpath');
		if (localStorage.getItem('documentId') != documentId) {
			
			localStorage.removeItem('documentId');
			localStorage.removeItem('documentName');
			localStorage.removeItem('documentFolderPath');
    		localStorage.setItem('documentId', documentId );
			localStorage.setItem('documentName', documentName );
			// localStorage.setItem('documentFolderPath', documentFolderPath);
		}
		
	});

