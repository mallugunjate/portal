<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
</head>
<body class="container-fluid">
	<!-- navbar begins -->
	<nav class="navbar navbar-default">
	    <div class="container-fluid">
	      <div class="navbar-header">
	        <a class="navbar-brand">
	          @if(isset($banner))
	          <span>{{$banner->name}}</span>
	          <input type="hidden" name="banner_id" value="{{$banner->id}}">
	          @endif
	        </a>
	        
	      </div>
	      
	    <ul class="nav navbar-nav">
	      <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banner <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="/admin/package/create?banner_id=1">Sportchek</a></li>
	            <li><a href="/admin/package/create?banner_id=2">Atmosphere</a></li>
	          </ul>
	      </li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	          <li><a href="/admin/home?banner_id={{$banner->id}}">View File Listing</a></li>
	    </ul>
	      
	    </div>
	    
	  </nav>
	<!-- navbar ends-->
	<div class="col-md-10 col-md-offset-1">
		
		{!! Form::open( ['action' => ['Document\PackageAdminController@store'], 'method'=>'POST']) !!}
		<input type="hidden" name="banner_id" value="{{$banner->id}}">
		<h3>Create Package</h3> 
		<div>
			Package Name: <input type="text" name="package_name" >
		</div>
		<div>
			Start :
			<div class="input-group date" id="datetimepicker1">
	          {!! Form::text('start', null, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
        </div>
        <div>
			End :
			<div class="input-group date" id="datetimepicker2">
	          {!! Form::text('end', null, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
        </div>


        <div>
        	Package hidden from store : <input type="checkbox" value=1 name="is_hidden">
        </div>

        <div>
        	{!! Form::label('tags[]', 'Tags') !!}
        	{!! Form::select('tags[]', $tags, null , ['class'=>'chosen', 'multiple'=>'true']) !!}
        </div>

        <div>
			<h5>Choose Files</h5>
			@foreach ($navigation as $nav) 
						
				@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )
					
					@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
					
				@endif

			@endforeach
		

			<input class="btn btn-default" type="button" id="attach-selected-files" value="Add Files" />
			<div id="files-selected">
				<p>Files To be added:</p>

			</div>
		
		</div>
		
		<button type="submit"> Create Package</button>
		{!! Form::close() !!}
	</div>


<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/custom/createpackage.js"></script>
<script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
<script type="text/javascript" src="/js/vendor/moment.js"></script>
<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
	$(".date").datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
    });

</script>
</body>
</html>
