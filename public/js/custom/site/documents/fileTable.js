

var fillTable = function(data){

	//console.log( data );

	$("#file-container").removeClass('hidden').addClass('visible');
	$("#file-uploader").removeClass('hidden').addClass('visible');
	$("#empty-container").removeClass('visible').addClass('hidden');
	$("#package-viewer").removeClass('visible').addClass('hidden');

	$(".topLevelNavItems").addClass('hidden');

	var banner_id = $("input[name='banner_id']").val();
	
	if ( data.folder.type == "week") {
		if( !(data.folder === null) ) {
			$("#folder-title h2").html('&nbsp;&nbsp;<i class="fa fa-folder-open"></i> ' + "Week " + data.folder.week_number)
			$("#folder-title").attr('data-folderId', data.folder.global_folder_id)
			$("#folder-title").attr('data-isWeekFolder', true)
		}	
	}
	else {
		if( !(data.folder === null) ) {
			$("#folder-title h2").html('&nbsp;&nbsp;<i class="fa fa-folder-open"></i> ' + data.folder.name);
			$("#folder-title").attr('data-folderId', data.folder.global_folder_id)
			$("#folder-title").attr('data-isWeekFolder', false)
		}	
	}


	$('#folder-table').empty();
	$('#folder-table').hide();

	$('#file-table').empty();

	if( (data.folder.folder_children).length > 0){
	// if( !(data.folder.folder_children === null) ) {		
		folderFill(data);
		$('#folder-table').show();
	}	
	
	fileFill(data);
}

var folderFill = function(data)
{

	if( !(data.folder.folder_children === null) ) {

		
		$('#folder-table').append('<thead>'+
								'<tr> <th> Name </th>'+
								'<th> Updated At </th>'+
								'</tr></thead>');
		var folders = data.folder.folder_children;
		// console.log(folders);
		$('#folder-table').append('<tbody>');
		_.each(folders, function(i){

			if (data.folder.has_weeks == 1) {

				$('#folder-table').append('<tr>'+
										' <td><i class="fa fa-folder"></i> <a class="folder" id="' + i.global_folder_id  +'" href="/document#!/' + i.global_folder_id + '"> Week ' +  i.week_number +'</a></td>'+
										' <td>' + i.updated_at +'</td>'+
									'</tr>')
			}
			else{

				$('#folder-table').append('<tr>'+
										' <td><i class="fa fa-folder"></i> <a class="folder" id="' + i.global_folder_id  +'" href="/document#!/' + i.global_folder_id + '">' + i.name+'</a></td>'+
										' <td>' + i.updated_at +'</td>'+
									'</tr>')

			}
			
		});
		$('#folder-table').append('</tbody>');
	
		$("#folder-table").tablesorter({
			sortReset : true,
			cssAsc: 'up',
    		cssDesc: 'down'
		});

	}
}


var fileFill = function(data)
{

	if( !(data.files === null) ) {
		$('#file-table').append('<thead>'+
								'<tr> <th> Title </th>'+
								' <th> Description </th>'+
								' <th> Uploaded At </th>'+
								' <th> Start </th>' +
								' <th> End </th>' +
								' </tr></thead>');
		var files = data.files
		
		$('#file-table').append('<tbody>');
		_.each(files, function(i){

			var icon ="";
			var row ="";
			

			switch(i.original_extension){
				case "png":
				case "jpg":
				case "gif":
				case "bmp":
					icon = "fa-file-image-o";
					row = '<tr> <td class="mail-subject"><a href="#" class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/'+i.filename+'" data-target="#fileviewmodal"><i class="fa '+ icon +'"></i> ' + i.title +'</a></td>'+
			//$('#file-table').append('<tr> <td><a data-toggle="modal" data-target="#fileviewmodal" href="/viewer/?file=/files/'+i.filename+'"><i class="fa '+ icon +'"></i> ' + i.title +'</a></td>'+				
										' <td>'+ i.description + '</td>'+
										' <td>'+ i.created_at +'</td>'+
										' <td>'+ i.start +'</td>' +
										' <td>'+ i.end +'</td>' +
										' </tr>'					
					break;

				case "pdf":
					icon = "fa-file-pdf-o";
					row = '<tr> <td class="mail-subject"><a href="#" class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/'+i.filename+'" data-target="#fileviewmodal"><i class="fa '+ icon +'"></i> ' + i.title +'</a></td>'+
			//$('#file-table').append('<tr> <td><a data-toggle="modal" data-target="#fileviewmodal" href="/viewer/?file=/files/'+i.filename+'"><i class="fa '+ icon +'"></i> ' + i.title +'</a></td>'+				
										' <td>'+ i.description + '</td>'+
										' <td>'+ i.created_at +'</td>'+
										' <td>'+ i.start +'</td>' +
										' <td>'+ i.end +'</td>' +
										' </tr>'
					break;

				case "xls":
				case "xlsx":
					icon = "fa-file-excel-o";
					break;

				case "mp4":
				case "avi":
				case "mov":
					icon = "fa-film";
					row = '<tr> <td class="mail-subject"><div class="launchVideoViewer" data-file="/files/'+i.filename +'?rnd='+ Math.random()*Math.random() + '" data-target="#videomodal"><i class="fa '+ icon +'"></i> ' + i.title +'</div></td>'+
			//$('#file-table').append('<tr> <td><a data-toggle="modal" data-target="#fileviewmodal" href="/viewer/?file=/files/'+i.filename+'"><i class="fa '+ icon +'"></i> ' + i.title +'</a></td>'+				
										' <td>'+ i.description + '</td>'+
										' <td>'+ i.created_at +'</td>'+
										' <td>'+ i.start +'</td>' +
										' <td>'+ i.end +'</td>' +
										' <td></td> </tr>'					
					break;

				case "doc":
				case "docx":
					icon = "fa-file-word-o";
					break;

				case "mp3":
				case "wav":
					icon = "fa-file-audio-o";
					break;

				case "ppt":
				case "pptx":
					icon = "fa-file-powerpoint-o";
					break;

				case "zip":
					icon = "fa-file-archive-o";
					break;

				case "html":
				case "css":
				case "js":
					icon = "fa-file-code-o";
					break;
					
				default: 
					icon = "fa-file-o";
					break;
			}

			$('#file-table').append(row);
		});

		$('#file-table').append('</tbody>');

		$("#file-table").tablesorter({
			sortReset : true,
			cssAsc: 'up',
    		cssDesc: 'down'
		});

	}

	
		
		$("body").on("click", ".launchPDFViewer", function(e){
			var filepath = $(this).attr("data-file");
			$("#fileviewmodal").find('iframe').attr("src", filepath);
		});

		$("body").on("click", ".launchVideoViewer", function(e){
			var filepath = $(this).attr("data-file");
			$("#videomodal").find('source').attr("src", filepath);
			$('#videomodal').modal('show');
			// data-toggle="modal"
		});		

		// $('#videomodal').on('shown.bs.modal', function() {
  //                   modalvideo[0].play();
  //               });

}	

