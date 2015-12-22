var fillUserTable = function(data){

	$("#user-viewer").removeClass('hidden').addClass('visible');
	$("#empty-container").removeClass('visible').addClass('hidden');
	$("#file-container").removeClass('visible').addClass('hidden');
	$("#file-uploader").removeClass('visible').addClass('hidden');
	$("#package-viewer").removeClass('visible').addClass('hidden');

	$("#user-table").empty();
	$('#user-table').append('<thead>'+
									'<tr> <th> Firstname </th>'+
									' <th> Lastname </th>'+
									' <th> Email </th>'+
									' <th> Group ID </th>'+
									' <th> Action </th> </tr></thead>');
	$('#user-table').append('<tbody>');
	_.each(data, function(i){
	$('#user-table').append('<tr> <td>'+ i.firstname +'</td>'+
								' <td>'+ i.lastname +'</td>'+
								' <td>'+ i.email +'</td>'+
								' <td>'+ i.group_id +'</td>'+
								' <td>'+
									'<a class="btn btn-xs btn-warning" href="/admin/user/'+ i.id +'/edit"> Edit </a>' +
									'<a class="delete-user btn btn-xs btn-danger" id="'+ i.id +'" > Delete </a>'+
								'</td> </tr>')
	});

	$('#user-table').append('</tbody>');
	$("#user-table").tablesorter({
		sortReset : true,
		cssAsc: 'up',
		cssDesc: 'down'
	});
}