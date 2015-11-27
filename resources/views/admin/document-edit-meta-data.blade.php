<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/vendor/bootstrap-datetimepicker.min.css">

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
          <li><a href="/admin/home?banner_id={{$banner->id}}">Back</a></li>
      </ul>
      
      
    </div>
    
  </nav>
  <!-- navbar ends-->
	<div class="col-md-6">
	{!! Form::model($document, ['action' => ['Document\DocumentAdminController@update', 'id'=>$document->id], 'method' => 'PUT']) !!}    
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

        <div class="form-group">
        {!! Form::label('start', 'Start Date : ') !!}
        <div class="input-group date" id="datetimepicker1">
          {!! Form::text('start', $document->start, ['class'=>'form-control',  'required']) !!}
          <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
          </span>      
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('end', 'End Date : ') !!}
        <div class="input-group date" id="datetimepicker2">
          {!! Form::text('end', $document->end, ['class'=>'form-control']) !!}      
          <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div> 
        </div>

       
        {!! Form::submit('Update Document!', ['class'=> 'col-md-2 form-control']) !!}
       

    {!! Form::close() !!}
    </div>
     <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/vendor/moment.js"></script>
    <script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function () {
        $(".date").datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
        });
      })
    </script>
</body>
</html>

