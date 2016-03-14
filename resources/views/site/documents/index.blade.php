<!DOCTYPE html>
<html>

<head>
    @section('title', 'Documents')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
{{--     <link rel="stylesheet" type="text/css" href="/css/skins/admin/skin.css"> --}}

    <style>
    .modal-lg{ height: 95%; width: 80% !important; padding: 0; }
    .modal-content{ height: 100% !important;}
    .modal-body{ padding: 0; margin: 0; height: 100% !important; }

    </style>
</head> 

<body class="fixed-navigation" onload="checkDeepLink()">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>

	   <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2>Documents</h2>
                <ol class="breadcrumb">
                    <li><a href="/{{ Request::segment(1) }}">Home</a></li>
                    <li><a href="/{{ Request::segment(1) }}/document">Documents</a></li>
                </ol>
            </div>

            <div class="col-lg-2 col-lg-offset-2 hidden" id="archive-switch" >
                <form class="form-inline" >
                    <div tyle="float:right">
                        <label>Archives</label>
                        
                            <div class="switch">
                                <div class="onoffswitch">
                                    
                                    <input type="checkbox" class="onoffswitch-checkbox" id="archives" name="archives">
                                    
                                    <label class="onoffswitch-label" for="archives">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                       
                    </div>
                </form>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="file-manager">
{{--                                 <h5>Show:</h5>
                                <a href="#" class="file-control active">Ale</a>
                                <a href="#" class="file-control">Documents</a>
                                <a href="#" class="file-control">Audio</a>
                                <a href="#" class="file-control">Images</a> --}}
{{--                                 <div class="hr-line-dashed"></div>
                                <button class="btn btn-primary btn-block">Upload Files</button> --}}
{{--                                 <div class="hr-line-dashed"></div> --}}
                                <h5>Folders</h5>

                                <ul class="tree" id="navigation-structure">
                                    
                                    @foreach ($navigation as $nav) 
                                        
                                        @if ( $nav["is_child"] == 0)
                                            
                                            @include('site.documents.foldernavigation-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
                                            
                                        @endif

                                    @endforeach
                                </ul>                             

                               <!--  <h5 class="tag-title">Tags</h5>
                                <ul class="tag-list" style="padding: 0">
                                    <li><a href="">Family</a></li>
                                    <li><a href="">Work</a></li>
                                    <li><a href="">Home</a></li>
                                    <li><a href="">Children</a></li>
                                    <li><a href="">Holidays</a></li>
                                    <li><a href="">Music</a></li>
                                    <li><a href="">Photography</a></li>
                                    <li><a href="">Film</a></li>
                                </ul> -->
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 animated fadeInRight">
                    
                    <div class="row">

                        <div class="col-lg-12">
                        <div id="file-container" class="ibox hidden">
{{--                             <div class="ibox-title">
                                <div class="ibox-tools">
                                    
                                </div>
                            </div> --}}


                            <div class="ibox-content">
                            
                                <input type="hidden" name="default_folder" value={{ $defaultFolder }}>
                                @include('site.documents.document-table')
                            
                            </div>
                        </div>

                        <div class="topLevelNavItems">
<!--                         <h1>Folders</h1> -->
                        @foreach ($navigation as $nav) 

                            @if ( $nav["is_child"] == 0)
                                
                                <div class="file-box">
                                    <div class="file">
                                        <a id="{{ $nav['id'] }}" class="parent-folder folder branch" href="/document#!/{{ $nav['id'] }}">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                <i class="fa fa-folder-open"></i>
                                            </div> 

                                        

                                            <div class="file-name">
                                                {{ $nav["label"] }}
                                                <br>
                                                {{-- <small>Added: Jan 11, 2014</small> --}}
                                            </div>
                                        </a>
                                    </div>
                                </div>                                

                            @endif

                        @endforeach
                        </div>



 

                        </div>

          
                    </div>


                    </div>

                    

                </div>
                </div>



    </div>

</div>
            @include('site.includes.footer')       
            @include('site.includes.scripts')
                

                <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
                <script type="text/javascript" src="/js/custom/tree.js"></script>
                <script type="text/javascript" src="/js/custom/site/documents/folderStructure.js" ></script>
                <script type="text/javascript" src="/js/custom/site/documents/breadcrumb.js" ></script>
                <script type="text/javascript" src="/js/custom/site/documents/fileTable.js" ></script>
                <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
                <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
                <script type="text/javascript" src="/js/custom/site/getArchivedContent.js"></script>
                <script type="text/javascript">
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

                    var defaultFolderId = $("input[name='default_folder']").val();

                    if (defaultFolderId) {
                        var folder = $("#"+defaultFolderId);
                        $("#"+defaultFolderId).parent().click();
                        $.ajax({
                            url : '/folder/' + defaultFolderId
                        })
                        .done(function(data){
                            console.log(data);
                            fillTable(data);
                        });
                    }
                </script>


                @include('site.includes.modal')

            </body>