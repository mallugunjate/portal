var fillBreadCrumbs = function(data)
{
	console.log("----- from breadcrumb");
	console.log(data);

	$('.breadcrumb').empty();

	if( !(data.folder.folder_path === null) ) {

		var folders = data.folder.folder_path;

		$('.breadcrumb').append('<li><a href="/">Home</a></li>');
		$('.breadcrumb').append('<li><a href="/document">Documents</a></li>');

		_.each(folders, function(i){
			
			$('.breadcrumb').append('<li><a class="folder" id="'+ i.global_folder_id+'" href="/document#!/'+ i.global_folder_id+'">'+i.name+'</a></li>');
		});
	}
}