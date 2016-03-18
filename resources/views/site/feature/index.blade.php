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

    #file-table tr td:last-child {
    white-space: nowrap;
    width: 1%
    }

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

                                <table class="table tablesorter table-hover" id="file-table"> 
                                    <thead>
                                        <tr> 
                                            <th> Title </th>
                                            <th> Added </th>
                                        </tr>
                                    </thead>

                                    @foreach ($feature_documents as $document)

                                        <tr> 
                                            <td> {!! $document->link_with_icon !!} </td>
                                            <td> {{ $document->prettyDate }} </td>                             
                                        </tr>                                        
                                    
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h2>Additional Documents</h2>
                                    </div>
                              
                                    <div class="ibox-content clearfix">
                                        <div class="row">
                                            <div class="col-lg-4 package-listing">
                                            @foreach($feature_packages as $package)

                                                @include('site.feature.package-listing', ['package'=>$package])
                                                
                                            @endforeach
                                            </div>

                                            <div class="col-lg-8 package-document-container ">


                                                @foreach($feature_packages as $package)
                                                    <div class="single-package-document-container hidden" data-packageid= {{$package->id}} > 
                                                        
                                                        <?php $package_document_listing = $package['details']['package_documents']; ?>
                                                    
                                                        <div class="package-document-listing" data-packageid= {{$package->id}} >
                                                            <div class="package-name" data-packageid= {{$package->id}}><h3> <i class="fa fa-folder-open-o"></i> {{$package->package_screen_name}} </h3></div>
                                                            <div class="col-md-12">
                                                            <table class="table tablesorter tablesorter-default">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Title</th>
                                                                        <th>Added</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                            @foreach ($package_document_listing as $document)
                                                            
                                                            
                                                                <tr>
                                                                    <td><div class="package-doc">{!! $document->link_with_icon !!}</div></td>
                                                                    <td>{!! $document->prettyDate !!} </td>
                                                                </tr>
                                                            
                                                               
                                                            @endforeach
                                                            </tbody>
                                                            </table>
                                                            </div>
                                                        </div>

                                                        <div class="package-folder-document-listing" data-packageid = {{$package->id}}>
                                                            <div class="folder-name" data-packageid= {{$package->id}}><h3></h3></div>
                                                            <div class="package-folder-documents col-md-12" data-packageid= {{$package->id}}>
                                                                <table class="table tablesorter tablesorter-default">
                                                                    
                                                                </table>

                                                            </div>
                                                        </div>
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
                                    <div class="ibox-content" style="max-height: 550px; overflow: auto;">

                                        
                                            <div class="feed-activity-list">

                                                @if(count($notifications)>0)

                                                    @foreach($notifications as $n)
                                                        
                                                        <div class="feed-element">                                           
                                                            <div class="media-body">
                                                                <span class="pull-left" style="padding: 0px 10px 0px 0px;">
                                                                    <h2 style="padding: 0; margin: 0;">{!! $n->linkedIcon !!}</h2>
                                                                </span>
                                                                <small class="pull-right" style="padding-left: 10px;">{{ $n->since }} ago</small>
                                                                <strong>{!! $n->link !!}</strong> 
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
    <script type="text/javascript" src="/js/custom/tree.js"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
    <script type="text/javascript" src="/js/custom/site/documents/fileTable.js"></script>
    <script type="text/javascript" src="/js/custom/site/features/showFeaturePackageDetails.js"></script>
    <script type="text/javascript">
        $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});
    </script>

    @include('site.includes.modal')


</body>
</html> 