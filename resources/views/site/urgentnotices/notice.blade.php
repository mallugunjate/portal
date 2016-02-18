<!DOCTYPE html>
<html>

<head>
    @section('title', 'Urgent Notice')
    @include('site.includes.head')
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <style>
    .modal-lg{ height: 95%; width: 80% !important; padding: 0; }
    .modal-content{ height: 100% !important;}
    .modal-body{ padding: 0; margin: 0; height: 100% !important; }

    </style>    
</head>	

<body class="fixed-navigation">

    <input type="hidden" id="communication_id" name="communication_id" value="{{ $notice->id }}">
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


		<div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
            	 <a href="../"><i class="fa fa-chevron-left"></i> Back</a>
                <h1>
                    {{ $notice->title }}
                     <span class="pull-right font-normal" style="font-size: 16px;">{{ $notice->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $notice->since }} ago)</small></span>
                </h1>
               
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    {!! $notice->description !!}
                </div>


                @if($notice->attachment_type_id == 1) {{-- folders --}}



                @endif

                @if($notice->attachment_type_id == 2) {{-- files --}}

                   <div class="mail-attachment">
                        <h3>
                            <span><i class="fa fa-paperclip"></i> {{ count($attached_documents) }} attachments</span>
                        </h3>

                        <div class="attachment">

                        	@foreach($attached_documents as $doc)

	                            <?php
	                            $icon="";
	                            $link="";
	                            switch($doc->original_extension){

									case "png":
									case "jpg":
									case "gif":
									case "bmp":
										$icon = "fa-file-image-o";				
										$link = '<a href="#">';
										break;

									case "pdf":
										$icon = "fa-file-pdf-o";
										$link = '<a href="#" class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/'.$doc->filename.'" data-target="#fileviewmodal">';
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
										$link = '<a href="#" class="launchVideoViewer" data-file="'.$doc->filename.'" data-target="#videomodal">';				
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
                            <div class="file-box">
                                <div class="file">
                                    {!! $link !!}

										<div class="icon">
                                            <i class="fa {{ $icon }}"></i>
                                        </div>


                                        <div class="file-name">
                                            {{ $doc->title }}
                                            <br />
                                            <small>{{ $doc->prettyDate }} &mdash; {{ $doc->since }} ago</small>
                                        </div>
                                    </a>
                                </div>

                            </div>

                            @endforeach

        
                            <div class="clearfix"></div>
                        </div>
					</div>

                @endif 


            </div>            

                
        
</div>



    @include('site.includes.footer')       

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    
    @include('site.includes.scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });     
    </script>
<!--     <script type="text/javascript" src="/js/custom/site/communications/markAsRead.js"></script> -->

 

    @include('site.includes.bugreport')
	@include('site.includes.modal')
</body>
</html> 