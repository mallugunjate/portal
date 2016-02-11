$(".urgent-notice-delete").on('click', function(){


    var urgent_notice_id = $(this).attr('data-urgent-notice-id');
    var selector = "#urgent_notice"+urgent_notice_id;

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
		    url: '/admin/urgentnotice/'+urgent_notice_id,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This Notice has been deleted.", "success");
		    }
		});
        
    });

    return false;

});