	$(".folder").click(function(){
		// console.log($(this).closest('li'));

		$.ajax(
			{
				url : '/documents',
				data : {
							folder : this.id,
							isWeekFolder : $(this).attr("data-isweek")
					   }
			}
		)
		.done(function(data){
			fillTable(data)
		});
	});
	
	var fillTable = function(data){

		console.log( data );

		$("#file-container").removeClass('hidden').addClass('visible');
		$("#file-uploader").removeClass('hidden').addClass('visible');
		$("#empty-container").removeClass('visible').addClass('hidden');
		$("#package-viewer").removeClass('visible').addClass('hidden');

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
				$('#file-table').append('<tr> <td>'+ i.title +'</td>'+
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
		console.log(package_id);
		$.ajax(
			{
				url : '/admin/package/' + package_id
			}
		)
		.done(function(data){
			console.log(data);
			showPackage(data);
		});

	})

	var showPackage = function(docPackage){

		$("#package-viewer").removeClass('hidden').addClass('visible');
		$("#empty-container").removeClass('visible').addClass('hidden');

		$("#package-viewer #package-name").empty();
		$("#package-viewer #package-details").empty();
		$("#package-viewer #package-name").append('<h4>' + docPackage.package.package_screen_name + '</h4>');
		_.each(docPackage.documentDetails, function(index){
			$("#package-viewer #package-details").append(	'<div class="package-files">' +
														'<div class="package-filename"> Filename : ' + index.original_filename + '</div>' +
														'<div class="package-filepath"> File Location : ' + index.folder_path + '</div>' +
														'<div class="package-timestamp"> Uploaded At : ' + index.created_at + '</div>' +
														'</div>'
														);
		});
	}

