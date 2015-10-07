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

        @if(!empty($params))
            @if ($params["param_name"] == "has_children")
            
                {!! Form::label('Children:') !!}
                @foreach($params["param_value"] as $child)
                    
                    <div class="form-group">
                        {{ $child["name"] }}
                        <a class="btn btn-default editFolder" href="/admin/folder/{{$child['id']}}/edit"> Edit </a>
                    </div>
                @endforeach
                <div class="form-group">
                    <button class="btn btn-default add-child">Add Child</button>
                </div>
            
            @elseif($params["param_name"] == "has_weeks")
                <div>
                    <label>
                        <input type="checkbox" name="removeWeeks" value=1 id="removeWeeks">
                        Remove week folders?
                    </label>
                </div>
            @endif
        @else 
            <div >
                
                <button class="btn btn-default" value="addWeek" id="addWeek"> Add Weeks </button>
                <div  id="addWeekContainer"></div>
                <button class="btn btn-default" value="addFolder" id="addFolder"> Add Folder </button>
                <div  id="addFolderContainer"></div>
                
            </div>
        @endif


        {!! Form::submit('Update Folder!', ['class'=> 'col-md-2 form-control']) !!}
       

    {!! Form::close() !!}
    </div>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/editFolder.js"></script>
</body>
</html>

