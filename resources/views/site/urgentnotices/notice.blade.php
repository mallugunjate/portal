<!DOCTYPE html>
<html>

<head>
    @section('title', 'Urgent Notice')
    @include('site.includes.head')
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
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

                <h2>
                    {{ $notice->title }}
                     <span class="pull-right font-normal" style="font-size: 16px;">{{ $notice->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $notice->since }} ago)</small></span>
                </h2>
                <a href="../"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    {!! $notice->description !!}
                </div>

                   <div class="mail-attachment">
                        <h3>
                            <span><i class="fa fa-paperclip"></i> 2 attachments</span>
                        </h3>

                        <div class="attachment">
                            <div class="file-box">
                                <div class="file">
                                    <a href="#">
                                        <span class="corner"></span>

                                        <div class="icon">
                                            <i class="fa fa-file"></i>
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

                                        <div class="image">
                                            <img alt="image" class="img-responsive" src="img/p1.jpg">
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

                                        <div class="image">
                                            <img alt="image" class="img-responsive" src="img/p2.jpg">
                                        </div>
                                        <div class="file-name">
                                            My feel.png
                                            <br>
                                            <small>Added: Jan 7, 2014</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        </div>

{{--                          
                        <div class="mail-body text-right tooltip-demo">
                                <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-reply"></i> Reply</a>
                                <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-arrow-right"></i> Forward</a>
                                <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn btn-sm btn-white"><i class="fa fa-print"></i> Print</button>
                                <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</button>
                        </div>
                        <div class="clearfix"></div>


                </div> --}}
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
    <script type="text/javascript" src="/js/custom/site/communications/markAsRead.js"></script>

 

    @include('site.includes.bugreport')

</body>
</html> 