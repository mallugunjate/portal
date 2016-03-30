<html>

<head>
    <title>Update Meta Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/css/vendor/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">


    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/vendor/moment.js"></script>
    <script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/js/custom/submitmetadata.js"></script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>

    <style>
    .glyphicon-ok{
    	color: #0c0; 
    	font-size: 14px; 
    	display: none;
    }
    </style>
</head>

<body class="adminview">
     <!-- navbar begins -->
      <nav class="navbar navbar-default">
        @include('admin.banner', ['banners'=>$banners])
        
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
            
            </div class="col-md-2">
                <label>Tags</label>
            <div>
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
                 {!! Form::select('tags[]', $tags, null, ['class'=>'chosen' , 'multiple'=>'true', 'id'=>"select$doc->id"]) !!}
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <div class='input-group date startdate' id='datetimepicker1-{{$doc->id}}'>
                      <input type='text' class="form-control" name="start" id="start{{$doc->id}}"/>
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <div class='input-group date enddate' id='datetimepicker2-{{$doc->id}}'>
                      <input type='text' class="form-control" name="end" id="end{{$doc->id}}"/>
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>
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
              <button type="submit" class="meta-data-done btn btn-success">Done</button>
              <span id="checkmark{{ $doc->id }}" aria-hidden="true"></span>
          </div>
          
          <div class="col-md-1">
            <br>
            <button type="submit" class="meta-data-add-all btn btn-success">Update All</button>
            <span class="glyphicon glyphicon-ok" id="checkmark{{ $doc->id }}" aria-hidden="true"></span>
          </div>
      </div>
    </div>
    <script type="text/javascript">
         $(function () {
            $(".startdate").datetimepicker({
              format: "YYYY-MM-DD HH:mm:ss",
              defaultDate : new Date()
            });
              
            $(".endDate").datetimepicker({
              format: "YYYY-MM-DD HH:mm:ss"
            });
        });
    </script>
</body>


</html>