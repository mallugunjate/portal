$(".folder").click(function(){
	// console.log(this);
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
	
	var fillTable = function(data){

		console.log(data)
		console.log(data.folder[0])
		if ( data.type == "week") {
			if( !(data.folder[0] === null) ) {
				$("#folder-title h2").html("Week " + data.folder[0].week_number)
				$("#folder-title").attr('data-folderId', data.folder[0].id)
				$("#folder-title").attr('data-isWeekFolder', true)
			}	
		}
		else {
			if( !(data.folder[0] === null) ) {
				$("#folder-title h2").html(data.folder[0].name);
				$("#folder-title").attr('data-folderId', data.folder[0].id)
				$("#folder-title").attr('data-isWeekFolder', false)
			}	
		}
		


		$('#file-table').empty();
		$('#file-table').append('<tr> <th> Title </th>'+
									' <th> Description </th>'+
									' <th> Folder </th>'+
									' <th> Uploaded At </th>'+
									' <th> Action </th> </tr>');
		if( !(data.files[0] === null) ) {
			var files = data.files[0]
			console.log(files)
			_.each(files, function(i){
				$('#file-table').append('<tr> <td>'+ i.title +'</td>'+
											' <td>'+ i.description +'</td>'+
											' <td> </td>'+
											' <td>'+ i.created_at +'</td>'+
											' <td> '+
												'<a href="/admin/document/'+ i.id +'/edit"> Edit </a> '+
												'<a class="deleteFile" id="'+ i.id +'" > Delete </a>'+
											'</td> </tr>')
			});

		}
		
		
	}

	
	$("body").on("click", ".deleteFile", function(e) {
		e.preventDefault();
		if (confirm('Are you sure you want to delete this file?')) {
		    $(this).closest('tr').fadeOut(500);
			$.ajax({
			    url: '/admin/document/'+ this.id,
			    type: 'DELETE',
			    data : {	
			    			_token : $('[name=_token').val()
					   }

			});
		} 
	});
})
