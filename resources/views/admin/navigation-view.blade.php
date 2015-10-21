<html>
<head>
	<title></title>
</head>
<body>
	<ul class="tree">
		{!! csrf_field() !!}
		@foreach ($navigation as $nav) 
			
			@if ( $nav["is_child"] == 0)
				
				@include('admin.navigation-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
				
			@endif


		@endforeach
	</ul>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</html>



