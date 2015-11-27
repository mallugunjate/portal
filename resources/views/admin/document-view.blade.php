<html>
<head>
	<title></title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/vendor/jquery-ui.theme.min.css">
  <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
	<link rel="stylesheet" type="text/css" href="/css/vendor/dz.css">
  <link rel="stylesheet" type="text/css" href="/css/vendor/dropzone.css">
	<link rel="stylesheet" type="text/css" href="/css/custom/document-upload.css">
  <link rel="stylesheet" type="text/css" href="/css/vendor/lightbox.css">

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
            <li><a href="/admin/home?banner_id=1">Sportchek</a></li>
            <li><a href="/admin/home?banner_id=2">Atmosphere</a></li>
          </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
          <li><a href="/admin/folderstructure?banner_id={{$banner->id}}">Edit Folders</a></li>
      </ul>
      
    </div>
    
  </nav>
  <!-- navbar ends-->
  <div id="admin-container" >
    <input type="hidden" name="banner_id" value="{{$banner->id}}">
  	<!-- <div class="row"> -->
  		<div class="navigation-container">
  			<!-- <div class="ui-widget-content"> -->
        <h4>Folders</h4>
        @include('admin.navigation-view', ['navigation'=>$navigation])
       <h4>Packages</h4>
       Packages Go here...
  		</div>
  		<div class="content-container">
        
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

  	<!-- </div> -->
  </div>
</body>
<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/custom/tree.js"></script>
<script type="text/javascript" src="/js/custom/folderStructure.js" ></script>
<script type="text/javascript" src="/js/vendor/dropzone.js"></script>
<script type="text/javascript" src="/js/custom/uploadDocument.js"></script>
<script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
<script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>


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

    
    $( ".navigation-container" ).resizable();

         
	});  

</script>
</html>

