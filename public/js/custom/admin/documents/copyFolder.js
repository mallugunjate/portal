

	$("#copy-folder").click(function(){

		console.log(localStorage.getItem('folderId'));
		var folderId = $(this).data('folderid');
		var folderName = $(this).data('foldername');

		// if (localStorage.getItem('folderId') != folderId) {
			localStorage.removeItem('folderId');
			localStorage.removeItem('folderName');
    		localStorage.setItem('folderId', folderId );
			localStorage.setItem('folderName', folderName );
		// }
		console.log(localStorage.getItem('folderId'));
		
	});

