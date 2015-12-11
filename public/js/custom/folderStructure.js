
	$(".folder").click(function(e){
		
		e.stopPropagation();
		var id = e.target.id;

		if(id){
			getFolderDocuments(e.target.id);
		} else {
			getFolderDocuments(this.id);
		}
		
	});

	var getFolderDocuments = function(id){
		
		var folder_id = id;
		$.ajax(
			{
				url : '/admin/document',
				data : {
							folder : folder_id,
							isWeekFolder : $(this).attr("data-isweek")
					   }
			}
		)
		.done(function(data){
			console.log(data);
			fillTable(data);
			setDeepLink(data);
		});
	}

	var checkDeepLink = function(){
		if(window.location.hash){
			folderId = window.location.hash.substr(3);
			$("li#" + folderId).click();
			//getFolderDocuments(folderId);
		}
	}
	var setDeepLink = function(data){
		var id = window.location.hash;
		console.log(id);
		console.log(window.location.pathname);
		location.href = window.location.pathname + "#!/" + data.folder.global_folder_id;
	}
	
	var fillTable = function(data){

		//console.log( data );

		$("#file-container").removeClass('hidden').addClass('visible');
		$("#file-uploader").removeClass('hidden').addClass('visible');
		$("#empty-container").removeClass('visible').addClass('hidden');
		$("#package-viewer").removeClass('visible').addClass('hidden');

		$(".topLevelNavItems").addClass('hidden');

		var banner_id = $("input[name='banner_id']").val();
		
		if ( data.type == "week") {
			if( !(data.folder === null) ) {
				$("#folder-title h2").html("Week " + data.folder.week_number)
				$("#folder-title").attr('data-folderId', data.folder.global_folder_id)
				$("#folder-title").attr('data-isWeekFolder', true)
			}	
		}
		else {
			if( !(data.folder === null) ) {
				$("#folder-title h2").html(data.folder.name);
				$("#folder-title").attr('data-folderId', data.folder.global_folder_id)
				$("#folder-title").attr('data-isWeekFolder', false)
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
												'<a class="btn btn-xs btn-primary" data-lightbox= "'+i.title+'"  href="/images/documents/thumb/'+ i.filename +'.jpg"> Preview </a> '+
												'<a class="btn btn-xs btn-warning" href="/admin/document/'+ i.id +'/edit?banner_id='+ banner_id +'"> Edit </a> '+
												'<a class="deleteFile btn btn-xs btn-danger" id="'+ i.id +'" > Delete </a>'+
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

	
	$("body").on("click", ".deleteFile", function(e) {
		console.log("file delete requested");
		e.preventDefault();
		if (confirm('Are you sure you want to delete this file?')) {
		    $(this).closest('tr').fadeOut(500);
			$.ajax({
			    url: '/admin/document/'+ this.id,
			    type: 'DELETE',
			    data : {	
			    			_token : $('[name=_token').val()
					   }

			})
			.done(function(data) {
				console.log(data);
			});
		} 
	});


	$(".package").click(function(){
		var package_id = $(this).attr('id');
		$.ajax(
			{
				url : '/admin/package/' + package_id
			}
		)
		.done(function(data){
			showPackage(data);
		});

	})

	var showPackage = function(docPackage){
		
		$("#package-viewer").removeClass('hidden').addClass('visible');
		$("#empty-container").removeClass('visible').addClass('hidden');
		$("#file-container").removeClass('visible').addClass('hidden');
		$("#file-uploader").removeClass('visible').addClass('hidden');

		$("#package-viewer #package-name").empty();
		$("#package-viewer #package-details").empty();
		$("#package-viewer #package-name").append(	'<div class="package-title">' + docPackage.package.package_screen_name + '</div>' +
													'<div class="package-timestamp"> Last Updated : ' + docPackage.package.updated_at + '</div>');
										
		$("#edit-package").attr('href', '/admin/package/'+ docPackage.package.id +'/edit?banner_id=1')
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


	$("#delete-package").on('click', function(e){
		e.preventDefault();
		var package_id = $(this).attr('data-package-id');
		console.log(package_id);
		$.ajax({
			method : "DELETE",
			url : "/admin/package/" + package_id,
			data : { "_token" : $('[name="_token"]').val()}
		}).done(function( data ){
			console.log(data);
			var banner_id = $("input[name='banner_id']").val();
			window.location = '/admin/home?banner_id=' + banner_id;
		});
	});

