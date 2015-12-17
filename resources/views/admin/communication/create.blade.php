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
		<h3>Create Communication</h3>
		
		{!! Form::open( ['action' => ['Communication\CommunicationAdminController@store'], 'method'=>'POST']) !!}

		<div>
			<input type="hidden" name="banner_id" value={{$banner->id}} >
		</div>
		<div>
			{!! Form::label('subject', 'Subject') !!}
			{!! Form::input('text', 'subject', null,  ['class'=>'form-control']) !!}
		</div>
		<div>
			{!! Form::label('body', 'Body') !!}
			{!! Form::textarea('body', null, ['class'=> 'communication_body']) !!}
		</div>
		<div>
			{!! Form::label('sender', 'Sender') !!}
			{!! Form::input('text', 'sender', null, ['class'=>'form-control']) !!}
		</div>
		<div>
			{!! Form::label('importance', 'Importance') !!}
			{!! Form::select('importance', $importance, null,  ['class'=>'form-control']) !!}
		</div>
		<div>
			{!! Form::label('send_at', 'Send On') !!}
			<div class="input-group date" id="datetimepicker1">
	          {!! Form::text('send_at', null, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
		</div>
		<div>
			{!! Form::label('archive_at', 'Archive On') !!}
			<div class="input-group date" id="datetimepicker1">
	          {!! Form::text('archive_at', null, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
		</div>

		<div>
			<div id="add-documents" class="btn btn-default">Add Documents</div>
		</div>

		<div>
			<div id="add-packages" class="btn btn-default">Add packages</div>		
		</div>

		<div>
			{!! Form::label('tags[]', 'Tags:') !!}
			{!! Form::select('tags[]', $tags , null,  ['class'=>'chosen', 'multiple'=>'true']) !!}
			
		</div>

		<div id="document-listing" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Documents</h4>
		            </div>
		            <div class="modal-body">
		            	@foreach ($navigation as $nav) 
						
							@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )
								
								@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
								
							@endif

						@endforeach
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" class="btn btn-primary" id="attach-selected-files">Select Documents</button>
		            </div>
		        </div>
		    </div>
		</div>

		

		<div id="package-listing" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Packages</h4>
		            </div>
		            <div class="modal-body">
		                @include('admin.package.file-package-structure-partial', ['packages'=>$packages])
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" class="btn btn-primary" id = "attach-selected-packages">Select Packages</button>
		            </div>
		        </div>
		    </div>
		</div>

		<div id="files-selected"></div>
		<div id="packages-selected"></div>
		<div>
			<button type="submit" class="btn btn-default">Submit</button>
		</div>
		{!! Form::close() !!}
	</div>


<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
<script type="text/javascript" src="/js/custom/createpackage.js"></script>
<script type="text/javascript" src="/js/custom/communication.js"></script>
<script type="text/javascript" src="/js/vendor/moment.js"></script>
<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
	$(".date").datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
    });

    CKEDITOR.replace('body');
    $("#add-documents").click(function(){
    	$("#document-listing").modal('show');
    });
    $("#add-packages").click(function(){
    	$("#package-listing").modal('show');	
    });



</script>
</body>
</html>
