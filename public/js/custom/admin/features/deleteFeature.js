$(".feature-delete").on('click', function(){


    var featureId = $(this).attr('data-feature');
    var selector = "#feature"+featureId;

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
		    url: '/admin/feature/'+featureId,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This feature has been deleted.", "success");
		    }
		});
        
    });

    return false;

});