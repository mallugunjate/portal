<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="col-md-6">
	{!! Form::model($folder, ['action' => ['FolderAdminController@update', 'id'=>$folder->id], 'method' => 'PUT']) !!}    
		<h2>Update Folder</h2>

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $folder->name, ['class'=>'form-control']) !!}
        </div>
            
         
        @if(isset($children) && count($children)>0)
            {!! Form::label('Children:') !!}
            @foreach ($children as $child)
                <div class="form-group">
                    {{ $child_folders[$child["child"]]["name"] }}
                    <a class="btn btn-default editFolder" href="/admin/folder/{{$child['child']}}/edit"> Edit </a>
                </div>
            @endforeach
            <div class="form-group">
                <button class="btn btn-default add-child">Add Child</button>
            </div>
        @endif

        @if(isset($has_weeks))
            <div>
                <label>
                    <input type="checkbox" name="removeWeeks" value=1 id="removeWeeks">
                    Remove week folders?
                </label>
            </div>
        @endif

        @if( (! isset($children)) && (!isset($has_weeks)) )
             <div >
                
                <button class="btn btn-default" value="addWeek" id="addWeek"> Add Weeks </button>
                <div  id="addWeekContainer"></div>
                <button class="btn btn-default" value="addFolder" id="addFolder"> Add Folder </button>
                <div  id="addFolderContainer"></div>
                
            </div>
            <br>
        @endif

        {!! Form::submit('Update Folder!', ['class'=> 'col-md-2 form-control']) !!}
       

    {!! Form::close() !!}
    </div>
     <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">

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
            
        
        
    </script>
</body>
</html>

