$(document).on('click','.event-delete',function(){

    var eventidVal = $(this).attr('data-event');
    var selector = "#event"+eventidVal;
//    var token = $('meta[name="csrf-token"]').attr('content');
	

    $.post("/admin/calendar/delete",{ event_id: eventidVal })
        .done( function(data){
            $(selector).closest('tr').fadeOut(1000);
        });
    return false;
});