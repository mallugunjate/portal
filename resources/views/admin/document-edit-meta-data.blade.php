<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
      
    </div>
    
  </nav>
  <!-- navbar ends-->
	<div class="col-md-6">
	{!! Form::model($document, ['action' => ['DocumentAdminController@update', 'id'=>$document->id], 'method' => 'PUT']) !!}    
		<h2>Update Document</h2>
        <input type="hidden" name="banner_id" value="{{$banner->id}}">

        <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', $document->title, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::text('description',$document->description, ['class'=>'form-control']) !!}      
        </div>

       
        {!! Form::submit('Update Document!', ['class'=> 'col-md-2 form-control']) !!}
       

    {!! Form::close() !!}
    </div>
     <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>

