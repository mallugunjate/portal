$(document).on('click','.event-delete',function(){

    var eventId = $(this).attr('data-event');
    var selector = "#event"+eventId;

    swal({
        title: "Are you sure?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
    	$.ajax({
		    url: '/admin/calendar/'+eventId,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This event has been deleted.", "success");
		    }
		});
        
    });



    return false;
});