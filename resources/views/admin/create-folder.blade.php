<html>
   <head>
       <title></title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

   </head>
   <body>
        <!-- navbar begins -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">
                        @if(isset($banner))
                            <span>{{$banner->name}}</span>
                        @endif
                    </a>
                </div>
                 <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin/folderstructure?banner_id={{$banner->id}}">Back to Folder Listing</a></li>
            </ul>
            </div>
           
        </nav>
        <!-- navbar ends-->

        <div class="col-md-10">

        {!! Form::open(array('action' => 'FolderAdminController@store', 'files' => false, 'class' => 'form-horizontal', 'role' => 'form')) !!}
            <input type="text" name="banner_id" id="banner_id" class="hidden">               
            <div class="col-md-8 col-sm-offset-1">
            <h2>Create Folder</h2>
            @if(isset($banner))
                <input name='banner_id' value={{$banner->id}} type="hidden">
            @endif
            <div class="row">
                <div class="form-group col-md-6 col-md-offset-1">
                    <label for="foldername">Folder Name</label>
                    <input type="text" class="form-control" id="foldername" name="foldername" value="">
                </div>
            </div>    
          
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                      
                        <input type="checkbox" name="subfolder" value="1" id="is_child">
                      
                        Is this a subfolder?
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="input-group">
                      
                        <input type="checkbox" name="has_weeks" value="1" id="has_weeks">
                      
                        Does the folder contain weeks?
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div>
            
            <div class="form-group hidden">
                <label>Week Window Size: </label>
                <input type="number" id="week_window_size" name="week_window_size" value="" min="1" step="2">
            </div>

            <div class="form-group">  
                
                <div class="col-sm-5 pull-right">
                   
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-ok"></span> Save</button>

                </div>

            </div>
            <div class="form-group"> 
                
            </div>
            </div>            
        {!! Form::close() !!}
        </div>
   </body>
   <script type="text/javascript">
        
        $("#banner li a").click(function(e){

            e.preventDefault();
            console.log($(this).attr("data-banner-id"));
            $("#banner_id").val($(this).attr("data-banner-id"));
            $(".navbar-brand").empty()
            $(".navbar-brand").append("<span>" + $(this).text() + "</span>")
          

        });

        $("#has_weeks").on("change", function(){
            if ($(this).is(':checked')) {
               $("#week_window_size").parent().removeClass("hidden").addClass("visible");
            }
            else{
                $("#week_window_size").parent().removeClass("visible").addClass("hidden");
            }
        })




   </script>
</html>       
