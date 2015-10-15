<html>
<head>
	<title></title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/tree.css">
	<link rel="stylesheet" type="text/css" href="/css/dz.css">
  <link rel="stylesheet" type="text/css" href="/css/dropzone.css">
	<link rel="stylesheet" type="text/css" href="/css/document-upload.css">
  <style type="text/css">
    #file-uploader {
      border: thin solid #e9e9e9;
      min-height:350px;
    }
    #watermark {
     position:relative;
     top:150px;
     text-align:center;
     font-size: 30px;
     z-index:1;
     color:#e9e9e9;
    }
    .navigation-container{
      border-right:thin solid #e9e9e9;
      height: 100%;
    }
  </style>

</head>
<body>
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
            <li><a href="/admin/home?banner_id=1">Sportchek</a></li>
            <li><a href="/admin/home?banner_id=2">Atmosphere</a></li>
          </ul>
      </li>
    </ul>
      
    </div>
    
  </nav>
  <!-- navbar ends-->
  <div id="admin-container" class= "col-md-10 ">
    <!-- <div class="row">
          <select id="banner_id" name="banner_id" class="form-control">
              <option > Choose Banner</option>
              <option value="1">Sportchek</option>
              <option value="2">Atmosphere</option>
          </select>    
    </div> -->
  	<div class="row">
  		<div class="col-md-2 navigation-container">
  			@include('admin.navigation-view', ['navigation'=>$navigation])
  		</div>
  		<div class="col-md-9 col-md-offset-1">
        <div id="empty-container" class="visible">
          <h4>Select a folder to view</h4>
        </div>
  			<div id="file-container" class="hidden">
          <input type="hidden" name="default_folder" value={{$defaultFolder}}>
  				@include('admin.document-table')
  			</div>
  			<div id="file-uploader" class="hidden">
          <div id="watermark">Drag and drop documents here</div>
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

    $(".dropdown-toggle").dropdown();
		$(".tree").treed({openedClass : 'glyphicon glyphicon-folder-open', closedClass : 'glyphicon glyphicon-folder-close'});
    
    var defaultFolderId = $("input[name='default_folder']").val();
    if (defaultFolderId) {
      var folder = $("#"+defaultFolderId);
      $("#"+defaultFolderId).parent().click();
      $.ajax(
      {
        url : '/documents',
        data : {
              folder : defaultFolderId,
              isWeekFolder : folder.attr("data-isweek")
             }
      }
      )
      .done(function(data){
        console.log(data);
        fillTable(data);
      });

    }
		// $("#banner_id").on("change", function() {
  //       var banner_id = $("#banner_id option:selected").val();
  //       window.location = "/admin/home?banner_id=" + banner_id;
  //   });

	});  

</script>
</html>

