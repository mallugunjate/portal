<!DOCTYPE html>
<html>

<head>
    @section('title', 'Document Manager')
    @include('admin.includes.head')
    <style type="text/css">
        .action{
            white-space: nowrap;
        }
    </style>
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
                <h2>Document Manager</h2>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/document">Documents</a></li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="file-manager">

                                <h5>{{$banner->name}}</h5>
                                    @include('admin.navigation-view', ['navigation'=>$navigation])
                                    <div id="file-container" class="hidden">
                                    <ol class="breadcrumbs"></ol>
                                    <input type="hidden" name="default_folder" value={{$defaultFolder}}>
                            {{--         @include('admin.documentmanager.document-table') --}}
                                    </div>
                                    <div id="package-viewer" class="hidden">
                                    @include('admin.package.view')
                                    </div>
                                    

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 animated fadeInRight">
                    
                    <div class="row">

                        <div class="col-lg-12">


                            <div id="file-container" class="ibox">



                                <div class="ibox float-e-margins">
                                

                                    <div class="ibox-title">
                                        
                                        <h5 id="folder-title"> <i class="fa fa-folder-open"></i> {{$banner->name}}</h5>
                                    
                                        <div class="ibox-tools">

                                             <a id="add-files" data-folderId="" href="/admin/document/create"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Files</button></a>
                                             <a id="add-folder" href="/admin/folder/create"><button type="button" class="btn btn-primary"><i class="fa fa-folder-open-o"></i> Add Sub Folder</button></a>
                                             <a id="edit-folder" href=""><button type="button" class="btn btn-primary" disabled><i class="fa fa-pencil"></i> Edit this Folder</button></a>

                                        </div>
                                    </div>


                                    <div class="ibox-content">
                                            <table class="table tablesorter" id="file-table"> 
                                            </table>
                                    </div>



                                </div> <!-- ibox closes -->


                            </div> <!-- file-container closes -->
                        </div>                
 

                    </div> <!-- row closes -->

          
                </div>


            </div>

                    

        </div>
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
    <script type="text/javascript" src="/js/custom/admin/folders/folderStructure.js" ></script>
    <script type="text/javascript" src="/js/custom/admin/documents/fileTable.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/deleteFile.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
    <script type="text/javascript" src="/js/custom/tree.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/editFolder.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/addFolder.js"></script>
    <script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>


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

        @include('site.includes.modal')
        @include('admin.folder.foldermodal')
        @include('site.includes.bugreport')
    </body>
</html>