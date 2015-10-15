<html>

<head>
    <title>Update Meta Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/js/submitmetadata.js"></script>    
    <style>
    .glyphicon-ok{
    	color: #0c0; 
    	font-size: 14px; 
    	display: none;
    }
    </style>
</head>

<body>
     <!-- navbar begins -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand">
             <!--  @if(isset($banner))
              <span>{{$banner->name}}</span>
              @endif -->
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
      <div id="admin-container" class= "col-md-10 col-md-offset-1">
      <div class="row">
          <div class="col-md-10">
          <h4>Edit the meta data for the files just uploaded</h4>
          </div>
      </div>
      <div >
      <div class="row well">
    	@foreach($documents as $doc)
    		
    			
    			<form id="metadataform{{ $doc->id }}" class="col-md-10">
    				
            <div class="row">
            <label >{{ $doc->original_filename }}</label><br /> 
            </div>

            <input type="hidden" name="file_id" value="{{ $doc->id }}">
    				
            
            <div class="row">
              <div class="col-md-5">
                <label >Title</label>
                <input type="text" class="form-control" name="title{{ $doc->id }}" id="title{{ $doc->id }}" value="{{$doc->original_filename}}">
  		        </div>

              <div class="col-md-5">
                <label >Description</label>
                <input class="form-control" type="text" name="description{{ $doc->id }}" id="description{{ $doc->id }}">
  		        </div>

              
              <div class="col-md-2">
                <br>
                <button type="submit" class="meta-data-add btn btn-success" data-id="{{ $doc->id }}">Update</button>
      				  <span class="glyphicon glyphicon-ok" id="checkmark{{ $doc->id }}" aria-hidden="true"></span>
              </div>
            </div>

    			</form>

        
    	@endforeach
      </div>
      </div>
    </div>
</body>

</html>