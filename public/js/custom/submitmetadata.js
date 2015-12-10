$(document).ready(function() {

    var updateDocument = $(document).on('click','.meta-data-add',function(){

        var token = $('meta[name="csrf-token"]').attr('content');
        var fileIdVal = $(this).attr('data-id');
        var titleVal = $("#title"+fileIdVal).val();
        var descriptionVal = $("#description"+fileIdVal).val();

        var tag_selector = "#select" + fileIdVal ;
        var tags = $(tag_selector).val();

        var start = $("#start"+fileIdVal).val();
        var end =  $("#end"+fileIdVal).val();
        var selector = "#metadataform"+fileIdVal;
        var check = "#checkmark"+fileIdVal;

        console.log(fileIdVal, titleVal, descriptionVal, selector, start, end, tags);
       
        if (start == "") {
            
            $("#start"+fileIdVal).parent().css("border", 'thin solid red');
            $('.error').remove()
            $("#start"+fileIdVal).closest('.col-md-2').append("<div class='row error'><div class='col-md-2'> *Required </div></div>")            
            return false;

        }
        $.post("/admin/document/add-meta-data",{ file_id: fileIdVal, title: titleVal, description: descriptionVal, start : start, end:end, _token:token , tags:tags})
            .done( function(data){
                console.log(data);
                $(check).fadeIn(1000);
                $("#start"+fileIdVal).parent().css("border", 'none');
                $('.error').remove()
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

    $('.chosen').chosen({
        width:'100%'
    })
});