	var fillTable = function(data){

		console.log("from fillTable");
		console.log(data);

		$("#file-container").removeClass('hidden').addClass('visible');
		$("#file-uploader").removeClass('hidden').addClass('visible');
		$("#empty-container").removeClass('visible').addClass('hidden');
		$("#package-viewer").removeClass('visible').addClass('hidden');

		$(".topLevelNavItems").addClass('hidden');

		var banner_id = $("input[name='banner_id']").val();
		
		if ( data.folder.type == "week") {
			if( !(data.folder === null) ) {
				$("#folder-title").html("<i class='fa fa-folder-open'></i> Week " + data.folder.week_number)
				$("#folder-title").attr('data-folderId', data.folder.global_folder_id)
				$("#add-files").attr('data-folderId', data.folder.global_folder_id)
				$("#folder-title").attr('data-isWeekFolder', true)
			}	
		}
		else {
			if( !(data.folder === null) ) {
				$("#folder-title").html("<i class='fa fa-folder-open'></i> " +  data.folder.name);
				$("#folder-title").attr('data-folderId', data.folder.global_folder_id)
				$("#add-files").attr('data-folderId', data.folder.global_folder_id)
				var currentHref = $("#add-files").attr('href');
				$("#add-files").attr('href', "/admin/document/create#!/"+data.folder.global_folder_id)
				$("#folder-title").attr('data-isWeekFolder', false)
			} else{


			}
		}
		


		$('#file-table').empty();
		
		if( !(data.files === null) ) {
			$('#file-table').append('<thead>'+
									'<tr> <th> Title </th>'+
									' <th> Description </th>'+
									' <th> Uploaded At </th>'+
									' <th> Start </th>' +
									' <th> End </th>' +
									' <th> Action </th> </tr></thead>');
			var files = data.files
			console.log(files)
			$('#file-table').append('<tbody>');
			_.each(files, function(i){

				var icon ="";
				console.log("ext: "  + i.original_extension);

				switch(i.original_extension){
					case "png":
					case "jpg":
					case "gif":
					case "bmp":
						icon = "fa-file-image-o";
						break;

					case "pdf":
						icon = "fa-file-pdf-o";
						break;

					case "xls":
					case "xlsx":
						icon = "fa-file-excel-o";
						break;

					case "mp4":
					case "avi":
					case "mov":
						icon = "fa-film";
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

				$('#file-table').append('<tr> <td><i class="fa '+ icon +'"></i> ' + i.title +'</td>'+
											' <td>'+ i.description +'</td>'+
											' <td>'+ i.created_at +'</td>'+
											' <td>'+ i.start +'</td>' +
											' <td>'+ i.end +'</td>' +
											' <td> '+
												// '<a class="btn btn-xs btn-primary" data-lightbox= "'+i.title+'"  href="/images/documents/thumb/'+ i.filename +'.jpg"> Preview </a> '+
												'<a class="btn btn-xs btn-primary" href="/admin/document/'+ i.id +'/edit"><i class="fa fa-pencil"></i></a> '+
												'<a class="deleteFile btn btn-xs btn-danger" id="'+ i.id +'" ><i class="fa fa-trash"></i></a>'+
											'</td> </tr>')
			});
			$('#file-table').append('</tbody>');
			$("#file-table").tablesorter({
				sortReset : true,
    			cssAsc: 'up',
        		cssDesc: 'down'
			});

		}
		
		
	}