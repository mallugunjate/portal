var fillBreadCrumbs = function(data)
{
	$('.breadcrumb').empty();

	if( !(data.folder.folder_path === null) ) {

		var folders = data.folder.folder_path;

		$('.breadcrumb').append('<li><a href="/">Home</a></li>');
		$('.breadcrumb').append('<li><a href="'+window.location.pathname+'">Documents</a></li>');

		_.each(folders, function(i){
			
			$('.breadcrumb').append('<li><a class="folder" id="'+ i.global_folder_id+'" href="'+window.location.pathname+'#!/'+ i.global_folder_id+'">'+i.name+'</a></li>');
		});
	}
}