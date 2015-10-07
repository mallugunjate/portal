
$("body").on('click', '.add-child', function(e){
    e.preventDefault();
    $(this).parent().append('<input type="text" name="child[]"><br>')
})

$("#removeWeeks").on("change", function(){
    
    if ($(this).is(':checked')) {
       console.log($(this).val())
    }
    else{
    }
})

$("body").on("click", ".deleteFolder", function(){
    console.log(this.id);
    if (confirm('Are you sure you want to delete this folder?')) {
    
        $.ajax({
            url: '/admin/folder/'+ (this).id,
            type: 'DELETE',
            data : {    
                        _token : $('[name=_token').val(),

                   }

        })
        .done(function(data){
            console.log(data)
            
        });
    } 
})

$("#addWeek").on("click", function(e){
    e.preventDefault()
    $("#addWeekContainer").empty()
    $("#addWeekContainer").append('<input type="number" name="week_window_size" id="weekFolder" placeholder="Week Window Size" class="form-control"><br>')
    $("#addFolderContainer").empty()
})
$("#addFolder").on('click', function(e){
    e.preventDefault()
    $("#addFolderContainer").append('<input type="text" name="child[]"  class="form-control"><br>')                
    $("#addWeekContainer").empty()
})  
    
