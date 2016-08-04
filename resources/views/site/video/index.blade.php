<!DOCTYPE html>
<html>

<head>
    @section('title', 'Video')

    @include('site.includes.head')

    <style>
    #page-wrapper{
    {{-- background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 1) 100%), url('/images/featured-backgrounds/{{ $feature->background_image }}') no-repeat 0px 50px; --}}
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

            <div class="row wrapper border-bottom white-bg page-heading">

                {{-- <h1 style="color: #333; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;padding-bottom: 0px; line-height: 50px;">Video Library</h1> --}}
                {{-- <div class="col-lg-10">
                    <h2>Video</h2>
                </div> --}}

                {{-- <div class="col-lg-2">

                </div> --}}

                <h2>Video Library</h2>

            </div>

            <div class="row">
                <div class="col-lg-12">

                    <video controls="controls" poster="/video/blink.jpg" style="">
                        <source src="/video/blink.webm" type="video/webm" />
                    </video>

                    <div class="ibox float-e-margins">
                        <div class="ibox-title clearfix">
                            <div class="pull-left">
                                <h1>This is the video title</h1>
                                <h6>Tags:</h6>
                                <span class="label">SOmething</span>
                                <span class="label">SOm3thing totally different</span>
                            </div>

                            <div class="pull-right">
                                    <h2>867,537 views</h2>
                                    <div class="progress progress-mini" style="margin-bottom: 10px;">
                                        <div style="width: 79%;" class="progress-bar"></div>
                                    </div>
                                    <button class="btn btn-white btn-outline" type="button" data-toggle="tooltip" data-placement="bottom" title="Like this"><i class="fa fa-thumbs-up"></i> 27</button>
                                    <button class="btn btn-white btn-outline" type="button" data-toggle="tooltip" data-placement="bottom" title="Dislike this"><i class="fa fa-thumbs-down"></i> 2</button>
                            </div>

                        </div>
                        <div class="ibox-content clearfix">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Most Viewed</h2>
                            </div>
                            <div class="ibox-content clearfix">
                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video title</h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video has a ridiculously long title for no real reason, who would do this? </h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video title</h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video title</h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video title</h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video title</h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video title lkna akl alk alk alka lka lak lak loiiap poia</h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video title</h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Most Liked</h2>
                            </div>
                            <div class="ibox-content clearfix">
                                @foreach($mostLiked as $ml)
                                    <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                        <a href="video/watch/{{$ml->id}}"><img src="/video/thumbs/{{$ml->thumbnail}}" class="img-responsive" /></a>
                                        <a href="video/watch/{{$ml->id}}"><h4>{{$ml->title}}</h4></a>
                                        <p>{{$ml->likes}} likes &middot; {{$ml->sinceCreated}} ago</p>
                                    </div>


                                @endforeach


                            </div>
                        </div>
                    </div>
            </div>


            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Most Recent</h2>
                            </div>
                            <div class="ibox-content clearfix">
                                This is where some videos will go
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
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>

    @include('site.includes.modal')

</body>
</html>
