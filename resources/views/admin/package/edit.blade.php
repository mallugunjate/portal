<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom/package.css">
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

		 {!! Form::model($package, ['action' => ['Document\PackageController@update', 'id'=>$package->id], 'method' => 'PATCH']) !!}
		<input type="hidden" name="banner_id" value="{{$banner->id}}">
		<h3>Edit Package : {{$package->package_screen_name}}</h3> 

		<div class="edit-package-details row">
			<label for="package-name"> Package Name</label>
			<input type="text" name="package_name"  value="{{$package->package_screen_name}}">

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
		<div class="file-listing row hidden">
			@foreach ($navigation as $nav) 
						
				@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )
					
					@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
					
				@endif

			@endforeach

			<input class="btn btn-default" type="button" id="add-files" value="Add Selected Files" />
			<div id="files-selected" >
				<p>Files To be added:</p>
			</div>
		</div>
		

		
		

		{!! csrf_field() !!}
		<div class="row">
			<button type="submit" class="btn btn-default">Update Package</button>
		</div>
		{!! Form::close() !!}
	</div>

<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/custom/createpackage.js"></script>
</body>
</html>
