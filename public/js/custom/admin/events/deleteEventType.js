$(document).on('click','.eventtype-delete',function(){

    var eventtypeidVal = $(this).attr('data-eventtype');
    var selector = "#eventtype"+eventtypeidVal;
	
	$.ajax({
	    url: '/admin/eventtypes/'+eventtypeidVal,
	    type: 'DELETE',
	    success: function(result) {
	        $(selector).closest('tr').fadeOut(1000);
	    }
	});

    return false;
});