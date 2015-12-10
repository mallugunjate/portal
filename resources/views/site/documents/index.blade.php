<!DOCTYPE html>
<html>

<head>
    @section('title', 'Documents')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
{{--     <link rel="stylesheet" type="text/css" href="/css/skins/admin/skin.css"> --}}
</head> 

<body class="fixed-navigation">
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
            <div class="col-lg-10">
                <h2>Documents &amp; Packages</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
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

                                <h5 class="tag-title">Tags</h5>
                                <ul class="tag-list" style="padding: 0">
                                    <li><a href="">Family</a></li>
                                    <li><a href="">Work</a></li>
                                    <li><a href="">Home</a></li>
                                    <li><a href="">Children</a></li>
                                    <li><a href="">Holidays</a></li>
                                    <li><a href="">Music</a></li>
                                    <li><a href="">Photography</a></li>
                                    <li><a href="">Film</a></li>
                                </ul>
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
                            
                                <input type="hidden" name="default_folder" value={{$defaultFolder}}>
                                @include('admin.document-table')
                            
                            </div>
                        </div>

                        <div class="topLevelNavItems">
                        <h1>Documents</h1>
                        @foreach ($navigation as $nav) 

                            @if ( $nav["is_child"] == 0)
                        
                                <div class="file-box folder">
                                    <div class="file">
                                        <a href="#">
                                            <span class="corner"></span>

{{--                                             <div class="icon">
                                                <i class="fa fa-folder"></i>
                                            </div> --}}

                                        <div class="image">
                                            <img alt="image" class="img-responsive" src="/images/p2.jpg">
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

                    <div class="topLevelNavItems">    
                        <h1>Packages</h1>
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="file-box">
                                    <div class="file">
                                        <a href="#">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                <i class="fa fa-archive"></i>
                                            </div>
                                            <div class="file-name">
                                                Document_2014.doc
                                                <br>
                                                <small>Added: Jan 11, 2014</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="file-box">
                                    <div class="file">
                                        <a href="#">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                <i class="fa fa-gift"></i>
                                            </div>
                                            <div class="file-name">
                                                Italy street.jpg
                                                <br>
                                                <small>Added: Jan 6, 2014</small>
                                            </div>
                                        </a>

                                    </div>
                                </div>

                                <div class="file-box">
                                    <div class="file">
                                        <a href="#">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                <i class="fa fa-cubes"></i>
                                            </div>
                                            <div class="file-name">
                                                My feel.png
                                                <br>
                                                <small>Added: Jan 7, 2014</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="file-box">
                                    <div class="file">
                                        <a href="#">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                <i class="fa fa-files-o"></i>
                                            </div>
                                            <div class="file-name">
                                                Michal Jackson.mp3
                                                <br>
                                                <small>Added: Jan 22, 2014</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="file-box">
                                    <div class="file">
                                        <a href="#">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="file-name">
                                                Document_2014.doc
                                                <br>
                                                <small>Added: Fab 11, 2014</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>   

                            </div>

                        </div>


                    </div>
                    </div>

                    

                </div>
                </div>



    </div>

</div>

{{--                 @include('site.includes.footer') --}}

                @include('admin.includes.scripts')
                
                <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
                <script type="text/javascript" src="/js/custom/tree.js"></script>
                <script type="text/javascript" src="/js/custom/folderStructure.js" ></script>
                <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
                <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
                <script type="text/javascript">
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $(".tree").treed({openedClass : 'glyphicon glyphicon-folder-open', closedClass : 'glyphicon glyphicon-folder-close'});

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
                </script>


                @include('site.includes.bugreport')

            </body>