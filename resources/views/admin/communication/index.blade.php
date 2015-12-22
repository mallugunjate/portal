
<html>
<head>
	<title></title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/vendor/jquery-ui.theme.min.css">
  <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
</head>
<body class="container-fluid">
  <!-- navbar begins -->
  <nav class="navbar navbar-default">
    @include('admin.banner', ['banners'=>$banners])
    
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
						<a href="/admin/communication/{{$communication->id}}" class="communication" >{{$communication->subject}}</a>
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
<script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
<script type="text/javascript" src="/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>

</html>

