<html>
<head>
	<title></title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="col-md-10 col-md-offset-1">
		<div class="row">
			<div class="col-md-4" >
				<h3>Folder Structure</h3>	
			</div>
			<div class="col-md-4 col-md-offset-4" >
				<select id="banner_id" class="form-control">
					<option>Select Banner</option>
					<option value="1">Sportchek</option>
					<option value="2">Atmosphere</option>
				</select>
			</div>
		</div>
		<div class="row">
			<ul class="tree">
				{!! csrf_field() !!}
				@foreach ($navigation as $nav) 
					
					@if ( $nav["is_child"] == 0)
						
						@include('admin.folderstructure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
						
					@endif


				@endforeach
			</ul>
		</div>
	</div>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">


	$("body").on("click", ".deleteFolder", function(e) {
		e.preventDefault();
		if (confirm('Are you sure you want to delete this folder?')) {
		    console.log($(this).attr('data-folderId'))
		    $(this).closest('li').fadeOut(500)
			$.ajax({
			    url: '/admin/folder/'+ $(this).attr('data-folderId'),
			    type: 'DELETE',
			    data : {	
			    			_token : $('[name=_token').val()
					   }

			})
			.done(function(data){
				console.log(data)
			});
		}
	})  

	$("#banner_id").on("change", function(){
		var banner_id = this.value;
		window.location = '/admin/folderstructure?banner_id='+banner_id
		
	});


</script>
</html>



