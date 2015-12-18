<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom/package.css">
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
</head>
<body class="container-fluid">
	<!-- navbar begins -->
	<nav class="navbar navbar-default">
		@include('admin.banner', ['banners' =>$banners])    
	    
	</nav>
	<!-- navbar ends-->
	<div class="col-md-10 col-md-offset-1">

		{!! Form::model($package, ['action' => ['Document\PackageAdminController@update', 'id'=>$package->id], 'method' => 'PATCH']) !!}
		<input type="hidden" name="banner_id" value="{{$banner->id}}">
		<h3>Edit Package : {{$package->package_screen_name}}</h3> 

		<div class="edit-package-details row">
			<label for="package-name"> Package Name</label>
			<input type="text" name="package_name"  value="{{$package->package_screen_name}}">

		</div>

		<div>
			Start :
			<div class="input-group date" id="datetimepicker1">
	          {!! Form::text('start', $package->start , ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
        </div>
        <div>
			End :
			<div class="input-group date" id="datetimepicker2">
	          {!! Form::text('end', $package->end, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
        </div>
        <div>
        	Package hidden from Store : <input type="checkbox" value=1 name="is_hidden" @if($package->is_hidden) {{"checked"}} @endif>
        </div>

        <div>
        	{!! Form::label('tags[]', 'Tags') !!}
        	{!! Form::select('tags[]', $tags, $selected_tags, ['class'=>'chosen', 'multiple'=>'true']) !!}

        </div>

		<div class="existing-files row">
			<div class="title">Existing Files</div>
			<div class="existing-files-container">
				@foreach($documentDetails as $doc)
				<div class="row">
					<div class="package-files col-md-8">
						<div class="package-filename"> {{$doc->original_filename}} </div>
						<div class="package-filepath"> File Location : {{$doc->folder_path}}</div>
						<div class="package-timestamp"> Uploaded At : {{$doc->created_at}}</div>
					</div>
					<div class="col-md-1 remove-file btn btn-default" data-document-id="{{$doc->id}}">Remove</div>
				</div>
				@endforeach
			</div>
		</div>
		<div id="files-staged-to-remove">

		</div>


		<div class="row">
			<div id="add-more-files" class="btn btn-default">Add More Files</div>
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

		<div id="files-selected">

		</div>
				
		{!! csrf_field() !!}
		<div class="row">
			<button type="submit" class="btn btn-default">Update Package</button>
		</div>
		{!! Form::close() !!}
	</div>
<script type="text/javascript">
	var start = {{$package->start}}
	var end = {{$package->end}}
</script>

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
