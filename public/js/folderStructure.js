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

		console.log(data)
		console.log(data.folder[0])
		if ( data.type == "week") {
			if( !(data.folder[0] === null) ) {
				$("#folder-title h2").html("Week " + data.folder[0].week_number)
				$("#folder-title").attr('data-folderId', data.folder[0].id)
			}	
		}
		else {
			if( !(data.folder[0] === null) ) {
				$("#folder-title h2").html(data.folder[0].name);
				$("#folder-title").attr('data-folderId', data.folder[0].id)
			}	
		}
		


		$('#file-table').empty();
		$('#file-table').append('<tr> <th> Title </th>'+
									' <th> Description </th>'+
									' <th> Folder </th>'+
									' <th> Uploaded At </th>  </tr>');
		if( !(data.files[0] === null) ) {
			var files = data.files[0]
			console.log(files)
			_.each(files, function(i){
				// console.log(i)
				$('#file-table').append('<tr> <td>'+ i.title +'</td>'+
											' <td>'+ i.description +'</td>'+
											' <td> </td>'+
											' <td>'+ i.created_at +'</td>  </tr>')
				// console.log(i.original_filename)
			})

		}
		
		
	})
})
