$(".package-delete").on('click', function(){


    var packageId = $(this).attr('data-package');
    var selector = "#package"+packageId;

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
		    url: '/admin/package/'+packageId,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This Package has been deleted.", "success");
		    }
		});
        
    });

    return false;

});