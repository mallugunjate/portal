<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom/communication.css">
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
</head>
<body class="container-fluid">
	<!-- navbar begins -->
	<nav class="navbar navbar-default">
		@include('admin.banner', ['banners'=>$banners])    
	    
	</nav>
	  
	<!-- navbar ends-->
	<div class="col-md-10 col-md-offset-1">
		<h3>Edit Communication</h3>
		
		{!! Form::model($communication, ['action' => ['Communication\CommunicationAdminController@update', 'id' => $communication->id], 'method'=>'PATCH']) !!}

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
			{!! Form::label('tags[]', 'Tags:') !!}
			{!! Form::select('tags[]', $tags , $selected_tags,  ['class'=>'chosen', 'multiple'=>'true']) !!}
		</div>

		<div class="documents-attached">
			<br>
			<div>Documents Attached:</div>
			<br>
			@foreach($communication_documents as $doc)
			
			<div class="row">
				<div class="communication-documents col-md-8">
					<div class="communication-filename"> {{$doc->original_filename}} </div>
					<div class="communication-filepath"> File Location : {{$doc->folder_path}}</div>
					<div class="communication-timestamp"> Uploaded At : {{$doc->created_at}}</div>
				</div>
				<div class="col-md-1 remove-document btn btn-default" data-document-id="{{$doc->id}}">Remove</div>
			</div>
			@endforeach


		</div>

		<div id="documents-staged-to-remove"></div>

		<div>	
			<div id="add-documents" class="btn btn-default">Add Documents</div>
		</div>
		<div id="files-selected"></div>


		<div class="packages-attached">
			<br>
			<div>Packages Attached:</div>
			<br>
			@foreach($communication_packages as $package)

			<div class="row">
				<div class="communication-packages col-md-8">
					<div class="communication-package-name"> <a href="/admin/package/{{$package->id}}"> {{$package->package_screen_name}} </a></div>
					<div class="communication-package-timestamp"> Package Last Updated : {{$package->updated_at}}</div>
				</div>
				<div class="col-md-1 remove-package btn btn-default" data-package-id="{{$package->id}}">Remove</div>
			</div>
			@endforeach

		</div>
		
		<div id="packages-staged-to-remove"></div>

		<div>
			<div id="add-packages" class="btn btn-default">Add packages</div>		
		</div>
		<div id="packages-selected"></div>

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

		
		
		<div>
			<button type="submit" class="btn btn-default">Submit</button>
		</div>
		{!! Form::close() !!}
	</div>


<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/custom/communication.js"></script>
<script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
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
