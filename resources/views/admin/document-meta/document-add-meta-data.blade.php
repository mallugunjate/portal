<!DOCTYPE html>
<html>

<head>
    @section('title', 'Upload New Documents')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation" onload="checkDeepLink()">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('admin.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('admin.includes.topbar')
        </div>

       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Update Meta Data <span id="folder-name-for-upload"></span></h2>
{{--                 <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/document">Documents</a></li>
                </ol> --}}
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">


                <div class="col-lg-12 animated fadeInRight">

          <h4>View or Edit files just uploaded</h4>

    
      <input type="hidden" name="banner_id" value="{{$banner->id}}">
      <input type="hidden" name="fo_id" value="{{$banner->id}}">

      <div class="row" id="document-record-container">
        <div class="row">
            <div class="col-md-2">
                <label>Filename</label><br>
            </div>
            <div class="col-md-2 ">
                <label >Title</label>
            </div>
            <div class="col-md-2">
                <label >Description</label>
            
{{--             </div class="col-md-2">
                <label>Tags</label>
            <div> --}}
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

{{--               <div class="col-md-2">
                 {!! Form::select('tags[]', $tags, null, ['class'=>'chosen' , 'multiple'=>'true', 'id'=>"select$doc->id"]) !!}
              </div> --}}

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



                @include('site.includes.footer')
                

                @include('admin.includes.scripts')


            <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
            <script type="text/javascript" src="/js/vendor/dropzone.js"></script>
            <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
            <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>

            <script type="text/javascript" src="/js/plugins/steps/jquery.steps.min.js"></script>

            <script type="text/javascript" src="/js/custom/admin/folders/documentUploadFolderStructure.js" ></script>
            <script type="text/javascript" src="/js/custom/admin/documents/fileTable.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/deleteFile.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/getPackages.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/deletePackage.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/showPackage.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/uploadDocument.js"></script>
            <script type="text/javascript" src="/js/custom/tree.js"></script>

        
                <script type="text/javascript">


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $(document).ready(function() {



                        var form = $("#example-advanced-form").show();
                         
                        form.steps({
                            headerTag: "h3",
                            bodyTag: "fieldset",
                            transitionEffect: "slideLeft",
                            onStepChanging: function (event, currentIndex, newIndex)
                            {
                                // Allways allow previous action even if the current form is not valid!
                                if (currentIndex > newIndex)
                                {
                                    return true;
                                }
                                // Forbid next action on "Warning" step if the user is to young
                                if (newIndex === 3 && Number($("#age-2").val()) < 18)
                                {
                                    return false;
                                }
                                // Needed in some cases if the user went back (clean up)
                                if (currentIndex < newIndex)
                                {
                                    // To remove error styles
                                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                                }
                                form.validate().settings.ignore = ":disabled,:hidden";
                                return form.valid();
                            },
                            onStepChanged: function (event, currentIndex, priorIndex)
                            {
                                // Used to skip the "Warning" step if the user is old enough.
                                if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
                                {
                                    form.steps("next");
                                }
                                // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                                if (currentIndex === 2 && priorIndex === 3)
                                {
                                    form.steps("previous");
                                }
                            },
                            onFinishing: function (event, currentIndex)
                            {
                                form.validate().settings.ignore = ":disabled";
                                return form.valid();
                            },
                            onFinished: function (event, currentIndex)
                            {
                                alert("Submitted!");
                            }
                        // }).validate({
                        //     errorPlacement: function errorPlacement(error, element) { element.before(error); },
                        //     rules: {
                        //         confirm: {
                        //             equalTo: "#password-2"
                        //         }
                        //     }
                        });



                         $(function () {
                            $(".startdate").datetimepicker({
                              format: "YYYY-MM-DD HH:mm:ss",
                              defaultDate : new Date()
                            });
                              
                            $(".endDate").datetimepicker({
                              format: "YYYY-MM-DD HH:mm:ss"
                            });
                        });

                        
                        $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});

                        var defaultFolderId = $("input[name='default_folder']").val();

                        if (defaultFolderId) {
                            var folder = $("#"+defaultFolderId);
                            $("#"+defaultFolderId).parent().click();
                            $.ajax({
                                url : '/admin/document',
                                data : {
                                    folder : defaultFolderId,
                                    isWeekFolder : folder.attr("data-isweek")
                                }
                            })
                            .done(function(data){
                                console.log(data);
                                fillTable(data);
                            });
                        }

                    }); 
                </script>

                @include('site.includes.bugreport')
            </body>
</html>