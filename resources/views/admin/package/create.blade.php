<html>
<head>
	<title></title>
</head>
<body>

	<h3>Create Package</h3> 

	<h5>Choose Files</h5>
	@foreach ($navigation as $nav) 
				
		@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )
			
			@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
			
		@endif




	@endforeach
	<input type="button" id="add-files" value="Add Files" />
	<div id="files">
		<p>Files To be added:</p>

	</div>
	Package Name: <input type="text" name="package-name">

	{!! csrf_field() !!}
	<input type="button" id="create-package" value="Create Package" />

<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/custom/createpackage.js"></script>
</body>
</html>
