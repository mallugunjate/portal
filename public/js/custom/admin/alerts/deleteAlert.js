$(document).on('click','.delete-alert',function(){

    var alertId = $(this).attr('data-alert');
    var selector = "#alert"+alertId;

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