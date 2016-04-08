$(document).on('click','.delete-alert',function(){

    var alertId = $(this).attr('data-alert');
    var selector = "#alert"+alertId;

    swal({
        title: "Really cancel this alert?",
        text: "The file will not be deleted",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No, thanks",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, cancel the alert",
        closeOnConfirm: false
    }, function () {
    	$.ajax({
		    url: '/admin/alert/'+alertId,
		    type: 'DELETE',
		    success: function(result) {
                $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This alert has been deleted.", "success");
		    }
		});
    });

    return false;
});