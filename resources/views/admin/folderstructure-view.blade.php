<html>
<head>
	<title></title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<ul class="tree">
		{!! csrf_field() !!}
		@foreach ($navigation as $nav) 
			
			@if ( $nav["is_child"] == 0)
				
				@include('admin.folderstructure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
				
			@endif


		@endforeach
	</ul>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">


	$("body").on("click", ".deleteFolder", function(e) {
		e.preventDefault();
		if (confirm('Are you sure you want to delete this folder?')) {
		    console.log($(this).attr('data-folderId'))
			$.ajax({
			    url: '/admin/folder/'+ $(this).attr('data-folderId'),
			    type: 'DELETE',
			    data : {	
			    			_token : $('[name=_token').val(),
			    			// isWeekFolder : $(this).attr("data-isWeek")
					   }

			})
			.done(function(data){
				console.log(data)
			});
		}
	})  


</script>
</html>



