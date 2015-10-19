<html>

<head>
    <title>Update Meta Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/moment.js"></script>
<!--     // <script type="text/javascript" src="/js/transition.js"></script>
    // <script type="text/javascript" src="/js/collapse.js"></script> -->
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>

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

      <div class="row well" id="document-record-container">
        <div class="row">
            <div class="col-md-2">
                <label>Filename</label><br>
            </div>
            <div class="col-md-2 ">
                <label >Title</label>
            </div>
            <div class="col-md-2">
                <label >Description</label>
            </div>
            <div class="col-md-2">
                <label>Start Date</label>
            </div>
            <div class="col-md-2">
                <label>End Date</label>
            </div>

        </div>
        <br>
    	@foreach($documents as $doc)
    		
    			
    			<form id="metadataform{{ $doc->id }}">
    				
            <input type="hidden" name="file_id" value="{{ $doc->id }}">
    				
            
            <div class="row" >
              <div class="col-md-2">
                <label >{{ $doc->original_filename }}</label>
              </div>
              
              <div class="col-md-2">
                <?php  $title = preg_replace('/\.'.preg_quote($doc->original_extension).'/', '', $doc->original_filename); ?>
                <input type="text" class="form-control" name="title{{ $doc->id }}" id="title{{ $doc->id }}" value="{{$title}}">
  		        </div>

              <div class="col-md-2">
                <input class="form-control" type="text" name="description{{ $doc->id }}" id="description{{ $doc->id }}">
  		        </div>

              <div class="col-md-2">
                <!-- <input class="form-control" type="text" name="start" value=""> -->
                <div class="form-group">
                  <div class='input-group date' id='datetimepicker1-{{$doc->id}}'>
                      <input type='text' class="form-control" />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>
                <script type="text/javascript">
                  $(function () {
                      console.log(new Date())
                      $("#datetimepicker1-"+{{$doc->id}}).datetimepicker({
                        format: "yyyy-mm-dd hh:ii",
                        autoclose: true,
                        todayBtn: true,
                        pickerPosition: "bottom-left",
                        initialDate: new Date()
                      });  
                  });
              </script>
              </div>

              <div class="col-md-2">
                <!-- <input class="form-control" type="text" name="end" value=""> -->
                <div class="form-group">
                  <div class='input-group date' id='datetimepicker2-{{$doc->id}}'>
                      <input type='text' class="form-control" />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>
                 <script type="text/javascript">
                  $(function () {

                      $("#datetimepicker2-"+{{$doc->id}}).datetimepicker({
                        format: "yyyy-mm-dd hh:ii",
                        autoclose: true,
                        todayBtn: true,
                        pickerPosition: "bottom-left"
                      });  
                  });
              </script>
              </div>
              
              <div class="col-md-2">
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