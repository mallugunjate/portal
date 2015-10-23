<html>
<head>
	<title></title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.min.css">
  <link rel="stylesheet" type="text/css" href="/css/tree.css">
	<link rel="stylesheet" type="text/css" href="/css/dz.css">
  <link rel="stylesheet" type="text/css" href="/css/dropzone.css">
	<link rel="stylesheet" type="text/css" href="/css/document-upload.css">

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
        @include('admin.navigation-view', ['navigation'=>$navigation])
       
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
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src= "/js/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/tree.js"></script>
<script type="text/javascript" src="/js/folderStructure.js" ></script>
<script src="/js/dropzone.js"></script>
<script type="text/javascript" src="/js/uploadDocument.js"></script>
<!-- <script type="text/javascript" src="/js/moment.js"></script> -->


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

    
    $( ".navigation-container" ).resizable(
          { 
            // maxWidth: 225, 
            // minWidth: 175,
            // alsoResizeReverse: ".content-container",
            // handles : 'e,w',
          //   resize: function( event, ui ) {
          //     ui.size.width = Math.round( ui.size.width / 30 ) * 30;
          //     // ui.size.height = ui.size.height;
          // } 
            
          });

         
	});  

</script>
</html>

