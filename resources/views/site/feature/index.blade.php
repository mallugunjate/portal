<!DOCTYPE html>
<html>

<head>
    @section('title', 'Feature: ' . $feature->title)
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/feature.css">
    <style>
    #page-wrapper{
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 1) 100%), url('/images/featured-backgrounds/{{ $feature->background_image }}') no-repeat 0px 50px; 
        background-size: cover;
        overflow: hidden;
    }

    #footer{
        position: fixed;
        bottom: 0px;
    }

    .modal-lg{ height: 95%; width: 80% !important; padding: 0; }
    .modal-content{ height: 100% !important;}
    .modal-body{ padding: 0; margin: 0; height: 100% !important; }    

    </style>
</head> 

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
              @include('site.includes.sidenav')
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg clearfix">
            <div class="row border-bottom">
                @include('site.includes.topbar')
            </div>

            <div class="wrapper wrapper-content">

            <h1 style="color: #fff; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 10px;">{{ $feature->title }}</h1>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Featured Documents</h2>
                            </div>
                      
                            <div class="ibox-content clearfix">

                                <table class="table tablesorter table-hover table-mail" id="file-table"> 
                                    <thead>
                                        <tr> 
                                            <th> Title </th>
                                            <th> Description </th>
                                            <th> Last Updated </th>
                                        </tr>
                                    </thead>

                                    @foreach ($feature_documents as $document)
                                        <?php
                                            $icon ="";
                                            $link ="";
                                            switch($document->original_extension){
                                                case "png":
                                                case "jpg":
                                                case "gif":
                                                case "bmp":
                                                    $icon = "fa-file-image-o";              
                                                    $link = '<a href="#">';
                                                    break;

                                                case "pdf":
                                                    $icon = "fa-file-pdf-o";
                                                    $link = '<a href="#" class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/'.$document->filename.'" data-target="#fileviewmodal">';
                                                    break;

                                                case "xls":
                                                case "xlsx":
                                                    $icon = "fa-file-excel-o";
                                                    $link = '<a href="#">';
                                                    break;

                                                case "mp4":
                                                case "avi":
                                                case "mov":
                                                    $icon = "fa-film";
                                                    $link = '<a href="#" class="launchVideoViewer" data-file="'.$document->filename.'" data-target="#videomodal">';              
                                                    break;

                                                case "doc":
                                                case "docx":
                                                    $icon = "fa-file-word-o";
                                                    $link = '<a href="#">';
                                                    break;

                                                case "mp3":
                                                case "wav":
                                                    $icon = "fa-file-audio-o";
                                                    $link = '<a href="#">';
                                                    break;

                                                case "ppt":
                                                case "pptx":
                                                    $icon = "fa-file-powerpoint-o";
                                                    $link = '<a href="#">';
                                                    break;

                                                case "zip":
                                                    $icon = "fa-file-archive-o";
                                                    $link = '<a href="#">';
                                                    break;

                                                case "html":
                                                case "css":
                                                case "js":
                                                    $icon = "fa-file-code-o";
                                                    $link = '<a href="#">';
                                                    break;
                                                    
                                                default: 
                                                    $icon = "fa-file-o";
                                                    $link = '<a href="#">';
                                                    break; 
                                            }
                                        ?>

                                        <tr> 
                                            <td>{!! $link !!}<i class="fa {{$icon}}"></i>&nbsp; {{$document->title}}</a></td>
                                            <td>{{$document->description}}</td>
                                            <td>{{$document->prettyDate}} <small class="text-muted pull-right"> {{ $document->since }} ago</small></td>                             
                                        </tr>                                        
                                    
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h2>Packages</h2>
                                    </div>
                              
                                    <div class="ibox-content clearfix">
                                        <div class="row">
                                            <div class="col-lg-4 package-listing">
                                            @foreach($feature_packages as $package)

                                                <div class="feature_package" id="feature-package-{{$package->id}}" data-packageId = {{$package->id}}>
                                                    <h4><i class="fa fa-gift"></i> {{$package->package_screen_name}} </h4>
                                                    <?php  $package_folder_listing = $package['details']['package_folders']; ?>
                                                    <?php  $package_folder_tree = $package['details']['package_folder_tree']; ?>
                                                    <div class="package-folder-listing hidden" data-packageid= {{$package->id}}>
                                                        
                                                        @foreach ($package_folder_listing as $folder)
                                                            <div class="package_folders" id="package-folder-{{$folder->global_folder_id}}" data-packageFolderId={{$folder->global_folder_id}}>
                                                                <?php $folderstructure = ($package['details']['package_folder_tree'][$folder->global_folder_id]); ?>
                                                                <?php $folder_root = ($package['details']['package_folder_tree'][$folder->global_folder_id][$folder->global_folder_id]); ?>
                                                                <ul class="tree">
                                                                @include('site.feature.folder-structure-partial', ['folderstructure' => $folderstructure, 'folder' =>$folder_root])
                                                                </ul>
                                                            </div>
                                                            
                                                        @endforeach
                                                    </div>
                                                </div>
                                                
                                            @endforeach
                                            </div>

                                            <div class="col-lg-8 package-document-container">


                                                @foreach($feature_packages as $package)
                                                    <?php $package_document_listing = $package['details']['package_documents']; ?>
                                                    
                                                    <div  class="package-document-listing hidden" data-packageid= {{$package->id}} >

                                                        @foreach ($package_document_listing as $document)
                                                        <div class="package_documents launchPDFViewer" data-toggle="modal" id="package-document-{{$document->id}}" data-packageDocumentId={{$document->id}} data-file="/viewer/?file=/files/{{$document->filename}}" data-target="#fileviewmodal"><i class="fa fa-file-pdf-o"></i>  {{$document->original_filename}} </div>
                                                        
                                                           
                                                        @endforeach
                                                    </div>

                                                    <div class="package-folder-document-listing hidden" data-packageid = {{$package->id}}>

                                                    </div>

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h2>Latest Updates</h2>
                                    </div>
                                    <div class="ibox-content">

                                        
                                            <div class="feed-activity-list">

                                                @if(count($notifications)>0)

                                                    @foreach($notifications as $n)
                                                        <?php
                                                            $icon ="";
                                                            $link ="";
                                                            switch($n->original_extension){
                                                                case "png":
                                                                case "jpg":
                                                                case "gif":
                                                                case "bmp":
                                                                    $icon = "fa-file-image-o";              
                                                                    $link = '<a href="#">';
                                                                    break;

                                                                case "pdf":
                                                                    $icon = "fa-file-pdf-o";
                                                                    $link = '<a href="#" class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/'.$n->filename.'" data-target="#fileviewmodal">';
                                                                    break;

                                                                case "xls":
                                                                case "xlsx":
                                                                    $icon = "fa-file-excel-o";
                                                                    $link = '<a href="#">';
                                                                    break;

                                                                case "mp4":
                                                                case "avi":
                                                                case "mov":
                                                                    $icon = "fa-film";
                                                                    $link = '<a href="#" class="launchVideoViewer" data-file="'.$n->filename.'" data-target="#videomodal">';              
                                                                    break;

                                                                case "doc":
                                                                case "docx":
                                                                    $icon = "fa-file-word-o";
                                                                    $link = '<a href="#">';
                                                                    break;

                                                                case "mp3":
                                                                case "wav":
                                                                    $icon = "fa-file-audio-o";
                                                                    $link = '<a href="#">';
                                                                    break;

                                                                case "ppt":
                                                                case "pptx":
                                                                    $icon = "fa-file-powerpoint-o";
                                                                    $link = '<a href="#">';
                                                                    break;

                                                                case "zip":
                                                                    $icon = "fa-file-archive-o";
                                                                    $link = '<a href="#">';
                                                                    break;

                                                                case "html":
                                                                case "css":
                                                                case "js":
                                                                    $icon = "fa-file-code-o";
                                                                    $link = '<a href="#">';
                                                                    break;
                                                                    
                                                                default: 
                                                                    $icon = "fa-file-o";
                                                                    $link = '<a href="#">';
                                                                    break; 
                                                            }
                                                        ?>
                                                        <div class="feed-element">
                                                            <span class="pull-left">
                                                                <h1><i class="fa {{ $icon }}"></i></h1>
                                                            </span>
                                                            <div class="media-body ">
                                                                <small class="pull-right">{{ $n->since }} ago</small>
                                                                <strong>{!! $link !!}{{ $n->title }}</a></strong> was {{ $n->verb }} <strong><a href="/{{ Request::segment(1) }}/document#!/{{ $n->global_folder_id }}">{{ $n->folder_name}}</a></strong>. <br>
                                                                <small class="text-muted">{{ $n->prettyDate }}</small>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>      

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           

                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')       
    @include('site.includes.scripts')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/custom/site/features/showFeaturePackageDetails.js"></script>
    <script type="text/javascript" src="/js/custom/tree.js"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
    <script type="text/javascript" src="/js/custom/site/documents/fileTable.js"></script>
    <script type="text/javascript" src="/js/custom/site/features/showFeaturePackageDetails.js"></script>
    <script type="text/javascript">
        $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});
    </script>

    @include('site.includes.bugreport')
    @include('site.includes.modal')


</body>
</html> 