$(document).on('click','.communicationtype-delete',function(){

    var eventtypeidVal = $(this).attr('data-communicationtype');
    var selector = "#communicationtype"+eventtypeidVal;

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
		    url: '/admin/communicationtypes/'+eventtypeidVal,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This Communication Type has been deleted.", "success");
		    }
		});
        
    });

    return false;
});