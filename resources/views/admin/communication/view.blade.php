<html>
<head>
	<title></title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/vendor/jquery-ui.theme.min.css">
  
  <link rel="stylesheet" type="text/css" href="/css/custom/communication.css">	
</head>
<body class="container-fluid adminview">
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
  		<div class="content-container col-md-offset-1 col-md-9">
        {!! csrf_field() !!}
        <div>
				    <h4>{{$communication->subject}}</h4>
				    <div id="communication_subject">
              <span class="communication-item-title">Content</span>
              {!!$communication->body!!}
				    </div>
            <div id="sender">
              <span class="communication-item-title">Sender : </span>
              {{$communication->sender}}
            </div>
            <div id="send_at">
              <span class="communication-item-title">Send At : </span>
              {{$communication->send_at}}
            </div>
            <div id="archive_at">
              <span class="communication-item-title">Archive At : </span>
              {{$communication->archive_at}}
            </div>
            <div>
              <span class="communication-item-title">Urgency : </span>
              {{$importance[$communication->importance]}}
            </div>

            <div>
              <span class="communication-item-title"> Documents Attached:</span>
              @foreach($communication_documents as $doc)
                <div>Filename : {{$doc->original_filename}}</div>
                <div>Location : {{$doc->folder_path}}</div>
                <br>
              @endforeach
            </div>
            <div>
              <span class="communication-item-title"> Packages Attached:</span>
              @foreach($communication_packages as $package)
                <div>Package name : {{$package->package_screen_name}}</div>
                <br>
              @endforeach
            </div>
            <div>
              <span class="comunication-item-title">Tags:</span>
                @foreach($selected_tags as $selected_tag)
                  {{$tags[$selected_tag]}}
                @endforeach
            </div>
        </div>
        
  		</div>
      <div class="col-md-2">
        <a href="/admin/communication/{{$communication->id}}/edit" class="btn btn-warning">Edit</a>
        <div class="delete-communication btn btn-danger"  id="{{$communication->id}}">Delete</div>
      </div>


  	<!-- </div> -->
  </div>
</body>

<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
<script type="text/javascript" src="/js/custom/communication.js"></script>
</html>

