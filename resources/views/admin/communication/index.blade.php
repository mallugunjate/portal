
<html>
<head>
	<title></title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/vendor/jquery-ui.theme.min.css">
  	
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
          <li><a href="/admin/folder?banner_id={{$banner->id}}">Edit Folders</a></li>
      </ul>
      
    </div>
    
  </nav>
  <!-- navbar ends-->
  <div id="admin-container" >
    <input type="hidden" name="banner_id" value="{{$banner->id}}">
    <!-- <div class="row"> -->
  		<div class="navigation-container">
  			<!-- <div class="ui-widget-content"> -->
  		</div>
  		<div class="content-container">
        
        	<div>
				<h4>Communications</h4>
				<div class="communication_list">
				@foreach($communications as $communication)
					<ul>
						<a href="/admin/communication/{{$communication->id}}?banner_id={{$banner->id}}" class="communication" >{{$communication->subject}}</a>
					</ul>
				@endforeach
				</div>
			</div>
        

  		</div>

  	<!-- </div> -->
  </div>
</body>
<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>

</html>

