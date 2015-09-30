$(document).ready(function() {

    $(document).on('click','.meta-data-add',function(){

        var token = $('meta[name="csrf-token"]').attr('content');
        var fileIdVal = $(this).attr('data-id');
        var titleVal = $("#title"+fileIdVal).val();
        var descriptionVal = $("#description"+fileIdVal).val();
        var selector = "#metadataform"+fileIdVal;
        var check = "#checkmark"+fileIdVal;

        $.post("/admin/document/add-meta-data",{ file_id: fileIdVal, title: titleVal, description: descriptionVal, _token:token })
            .done( function(data){
                console.log('stuff happpend');
                //$(selector).closest('.glyphicon-ok').fadeIn(1000);
                $(check).fadeIn(1000);
            });
        return false;
    });

});