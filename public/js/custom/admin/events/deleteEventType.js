$(document).on('click','.eventtype-delete',function(){

    var eventtypeidVal = $(this).attr('data-eventtype');
    var selector = "#eventtype"+eventtypeidVal;

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
		    url: '/admin/eventtypes/'+eventtypeidVal,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This Event Type has been deleted.", "success");
		    }
		});
        
    });

    return false;
});