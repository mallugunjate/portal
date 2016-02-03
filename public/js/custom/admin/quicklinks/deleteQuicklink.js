$(document).on('click','.quicklink-delete',function(){

    var linkId = $(this).attr('data-quicklink');
    var selector = "#quicklink"+linkId;

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
		    url: '/admin/quicklinks/'+linkId,
		    type: 'DELETE',
		    success: function(result) {
                $("#quicklinkslist").find("[data-id='" + linkId + "']").fadeOut(1000);
		        swal("Deleted!", "This quicklink has been deleted.", "success");
		    }
		});
    });

    return false;
});