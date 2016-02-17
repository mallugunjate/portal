$(".delete-communication").click(function(){

	var commId = $(this).attr('data-communication');
	var selector = "#communication"+commId;

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
		    url: '/admin/communication/'+ commId,
		    type: 'DELETE',

		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This communication has been deleted.", "success");
		    }

		});
        
    });

    return false;
});