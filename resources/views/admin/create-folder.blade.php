<html>
   <head>
       <title></title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

   </head>
   <body>
        

        {!! Form::open(array('action' => 'FolderAdminController@store', 'files' => false, 'class' => 'form-horizontal', 'role' => 'form')) !!}
             
            <select id="banner_id" name="banner_id" class="form-control">
                <option value="1">Sportchek</option>
                <option value="2">Atmosphere</option>
            </select>               
            <div class="col-md-8 col-sm-offset-1">
            <h2>Create Folder</h2>

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
   </body>
   <script type="text/javascript">
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
