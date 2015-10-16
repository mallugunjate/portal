$(document).ready(function() {

    var updateDocument = $(document).on('click','.meta-data-add',function(){

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

    $(".meta-data-done").on("click", function(){
        var banner_id = $("input[name='banner_id']").val();
        var folder_id = $("input[name='folder_id']").val()
        window.location ='/admin/home?banner_id='+banner_id+'&parent='+folder_id;
    });

    $(".meta-data-add-all").on("click", function(){
        var updateButtons = $(".meta-data-add");
        for (var i=0 ; i<updateButtons.length; i++) {
            updateButtons[i].click();
        }
    });

});