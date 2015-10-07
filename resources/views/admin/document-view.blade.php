<html>
<head>
	<title></title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/tree.css">
	<link rel="stylesheet" type="text/css" href="/css/dz.css">
    <link rel="stylesheet" type="text/css" href="/css/dropzone.css">
	<link rel="stylesheet" type="text/css" href="/css/document-upload.css">


</head>
<body>
  <div id="admin-container" class= "col-md-10 ">
    <div class="row">
          <select id="banner_id" name="banner_id">
              <option > Choose Banner</option>
              <option value="1">Sportchek</option>
              <option value="2">Atmosphere</option>
          </select>    
    </div>
  	<div class="row">
  		<div class="col-md-3">
  			@include('admin.navigation-view', ['navigation'=>$navigation])
  		</div>
  		<div class="col-md-9">
  			<div id="file-container">
  				@include('admin.document-table')
  			</div>
  			<div id="file-uploader">
  				@include('admin.document-upload')
  			</div>

  		</div>

  	</div>
  </div>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src= "/js/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/tree.js"></script>
<script type="text/javascript" src="/js/folderStructure.js" ></script>
<script src="/js/dropzone.js"></script>
<script type="text/javascript" src="/js/uploadDocument.js"></script>


<script>
	$(document).ready(function() {
		$(".tree").treed({openedClass : 'glyphicon glyphicon-folder-open', closedClass : 'glyphicon glyphicon-folder-close'});

		$("#banner_id").on("change", function() {
        var banner_id = $("#banner_id option:selected").val();
        window.location = "/admin/home?banner_id=" + banner_id;
    });
	});  

</script>
</html>

