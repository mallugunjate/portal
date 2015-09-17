<html>

<head>
    <title>File Upload</title>
   
    <script src="/js/dropzone.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/dropzone.css">
    <style>
/*    .dropzone{
        border: 0;
    }
    .dz-default{
        display: block;
        border: thin dashed lime;
        height: 100px;
        width: 400px;
    }

    .dz-error-message{ display: none; }*/
    </style>
</head>


<body>
    <p>this is the document upload view</p>



    {!! Form::open(array('action' => 'DocumentAdminController@store', 'files' => true, 'class' => 'dropzone', 'role' => 'form')) !!}
        
        <label>Choose a folder</label>
        <select id="folderselected" name="folderselected">
        @foreach($folders as $folder)
            <option value="{{ $folder->id }}">{{ $folder->name }}</option>
        @endforeach
        </select>

        {!! Form::file('document') !!}

                        	
    {!! Form::close() !!}


        
</body>

</html>