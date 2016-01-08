
$("body").on('click', '.addChild', function(e){
    e.preventDefault();
    $("#addChildFolderContainer").show();
    $("#addChildFolderContainer").append('<h6>Folder Name<input type="text" name="child[]"  class="form-control"></h6>');  
})

$("#removeWeeks").on("change", function(){
    
    if ($(this).is(':checked')) {
       console.log($(this).val());
    }
    else{
    }
})

$("body").on("click", ".deleteFolder", function(e){
    var folderId = $(this).attr('data-id');//$(this).id;
    var selector = "#folder"+folderId;
    
    console.log("folderId: "+folderId);
    console.log("selector: "+selector);
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
            url: '/admin/folder/'+ folderId,
            type: 'DELETE',
            success: function(result) {
                // $(selector).closest('tr').fadeOut(1000);
                swal("Deleted!", "This folder has been deleted.", "success");
            }
        })
        .done(function(data){ 
            $('#mmmm-modal').modal('toggle');
            $(selector).fadeOut(500);
            //window.location = '/admin/folder';
        });
        
    });

    return false;

    // if (confirm('Are you sure you want to delete this folder?')) {
    
    //     $.ajax({
    //         url: '/admin/folder/'+ (this).id,
    //         type: 'DELETE',
    //         data : {    
    //                     _token : $('[name=_token').val(),
    //                }

    //     })
    //     .done(function(data){ 
    //         console.log(data);
    //         window.location = '/admin/folder';
    //     });
    // } 
});

$("#addWeek").on("click", function(e){
    e.preventDefault();
    $("#addWeekContainer").empty();
    $("#addWeekContainer").show();
    $("#addFolderContainer").hide();
    $("#addWeekContainer").append('<input type="number" name="weekWindowSize" id="weekFolder" placeholder="Week Window Size" class="form-control"><br>');
    $("#addFolderContainer").empty();
  
})
$("#addFolder").on('click', function(e){
    e.preventDefault();
    $("#addFolderContainer").show();
    $("#addWeekContainer").hide();
    $("#addFolderContainer").append('<h6>Folder Name<input type="text" name="child[]"  class="form-control"></h6>');
    $("#addWeekContainer").empty();
  
})  
    
