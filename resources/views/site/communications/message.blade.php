<!DOCTYPE html>
<html>

<head>
    @section('title', 'Communications')
    @include('site.includes.head')
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/css/custom/site/feature.css">
</head>	

<body class="fixed-navigation">

    <input type="hidden" id="communication_id" name="communication_id" value="{{ $communication->id }}">
    <input type="hidden" id="store_id" name="store_id" value="{{ Request::segment(1) }}">

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



<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2">

            @include('site.communications.commsidebar')

            </div>

<div class="col-lg-10 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
                    {{ $communication->subject }}
                     <span class="pull-right font-normal" style="font-size: 16px;">{{ $communication->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $communication->since }} ago)</small></span>
                </h2>

            </div>
                <div class="mail-box">


                    <div class="mail-body">
                        {!! $communication->body !!}
                    </div>

                    <div class="mail-attachment">
                    <h3>
                        <span><i class="fa fa-paperclip"></i> {{ count($communication_documents) }} Document</span>
                    </h3>
                    @foreach($communication_documents as $doc)

                            <div class="file-box">
                               <div class="file">
                                    

                                        <div class="icon">
                                            <i class="fa fa-file"></i>
                                        </div>


                                        <div class="file-name">
                                            <div style="font-size: 16px; padding-bottom: 10px;"> {{ $doc->title }}</div>
                                            
                                            <small class="clearfix"><span class="text-muted pull-left">{{ $doc->prettyDate }}</span> <span class="text-muted pull-right">{{ $doc->since }} ago</span></small>

                                        </div>
                                
                                </div>

                            </div>                    
                    
                    @endforeach
                    <div class="clearfix"></div>
                    </div>

                    <div class="mail-attachment">
                        <h3>
                            <span><i class="fa fa-paperclip"></i> {{ count($communication_packages) }} Packages</span>
                        </h3>
            
                        <div class="row">
                            <div class="col-lg-4 package-listing">
                            @foreach($communication_packages as $package)

                                @include('site.feature.package-listing', ['package'=>$package])
                                
                            @endforeach
                            </div>

                            <div class="col-lg-8 package-document-container">


                                @foreach($communication_packages as $package)
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
                    
                    <div class="clearfix"></div>
                    </div>



            </div>            

                
        
</div>



    @include('site.includes.footer')       

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    
    @include('site.includes.scripts')
   
    <script type="text/javascript" src="/js/custom/tree.js"></script>
    <script type="text/javascript" src="/js/custom/site/communications/markAsRead.js"></script>
    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/custom/site/features/showFeaturePackageDetails.js"></script>

     <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});

    </script>

    @include('site.includes.bugreport')

</body>
</html> 