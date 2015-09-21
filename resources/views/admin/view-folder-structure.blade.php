<html>
<head>
	<title></title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/tree.css">
	


</head>
<body>
	<p>Current Folder Structure</p>
	<ul class="tree">
	@foreach ($navigation as $nav) 
		
		@if ( $nav["is_child"] == 0)
			
			
			@include('admin.navigation-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
			
		@endif

	
	@endforeach
	</ul>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/tree.js"></script>
<script>
	$(document).ready(function(){
		$(".tree").treed({openedClass : 'glyphicon glyphicon-folder-open', closedClass : 'glyphicon glyphicon-folder-close'});
	})

</script>
</html>

