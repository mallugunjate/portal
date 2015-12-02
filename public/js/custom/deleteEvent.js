$(document).on('click','.event-delete',function(){

    var eventidVal = $(this).attr('data-event');
    var selector = "#event"+eventidVal;
	
	$.ajax({
	    url: '/admin/calendar/'+eventidVal,
	    type: 'DELETE',
	    success: function(result) {
	        $(selector).closest('tr').fadeOut(1000);
	    }
	});

    return false;
});