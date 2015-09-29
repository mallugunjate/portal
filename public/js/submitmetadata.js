$(document).ready(function() {

    $(document).on('click','.meta-data-add',function(){

        var token = $('meta[name="csrf-token"]').attr('content');
        var fileIdVal = $(this).attr('data-id');
        var titleVal = $("#title"+fileIdVal).val();
        var descriptionVal = $("#description"+fileIdVal).val();
       // var selector = "#comment"+commentidVal;

        $.post("/admin/document/add-meta-data",{ file_id: fileIdVal, title: titleVal, description: descriptionVal, _token:token })
            .done( function(data){
              //  $(selector).closest('tr').fadeOut(2000);
            });
        return false;
    });

});