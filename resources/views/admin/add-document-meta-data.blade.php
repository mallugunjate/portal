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
              @if(isset($banner))
              <span>{{$banner->name}}</span>
              @endif
            </a>
            <input type="hidden" name="folder_id" value="{{$folder_id}}">
          </div>
        </div>
        
      </nav>
      <!-- navbar ends-->
      <div id="admin-container" class= "col-md-10 col-md-offset-1">
      <div class="row">
          <div class="col-md-10">
          <h4>View or Edit files just uploaded</h4>
          </div>
      </div>

      <input type="hidden" name="banner_id" value="{{$banner->id}}">
      <input type="hidden" name="fo_id" value="{{$banner->id}}">

      <div class="row well">
        <div class="row">
            <div class="col-md-3">
                  <label>Filename</label><br>
            </div>
            <div class="col-md-3 ">
                  <label >Title</label>
            </div>
            <div class="col-md-4">
                <label >Description</label>
            </div>

        </div>
        <br>
    	@foreach($documents as $doc)
    		
    			
    			<form id="metadataform{{ $doc->id }}">
    				
            <input type="hidden" name="file_id" value="{{ $doc->id }}">
    				
            
            <div class="row" >
              <div class="col-md-3">
                <!-- <label>Filename</label><br> -->
                <label >{{ $doc->original_filename }}</label>
              </div>
              
              <div class="col-md-3 ">
                <!-- <label >Title</label> -->
                <input type="text" class="form-control" name="title{{ $doc->id }}" id="title{{ $doc->id }}" value="{{$doc->original_filename}}">
  		        </div>

              <div class="col-md-4">
                <!-- <label >Description</label> -->
                <input class="form-control" type="text" name="description{{ $doc->id }}" id="description{{ $doc->id }}">
  		        </div>

              <div class="col-md-2">
                <!-- <br> -->
                <button type="submit" class="meta-data-add btn btn-success" data-id="{{ $doc->id }}">Update</button>
                <span class="glyphicon glyphicon-ok" id="checkmark{{ $doc->id }}" aria-hidden="true"></span>
              </div>

            </div>  

    			</form>

        
    	@endforeach
      
      </div> <!-- well ends -->
      <div class="row"  >
          <div class="col-md-1 col-md-offset-10">
              <br>
              <button type="submit" class="meta-data-done btn btn-warning">Done</button>
              <span id="checkmark{{ $doc->id }}" aria-hidden="true"></span>
          </div>
          
          <div class="col-md-1">
            <br>
            <button type="submit" class="meta-data-add-all btn btn-success">Update All</button>
            <span class="glyphicon glyphicon-ok" id="checkmark{{ $doc->id }}" aria-hidden="true"></span>
          </div>
      </div>
    </div>
</body>

</html>