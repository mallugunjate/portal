<!DOCTYPE html>
<html>

<head>
    @section('title', $video[0]->title)

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



            </div>

            <div class="row">
                <div class="col-lg-12">

                    <video controls="controls" poster="/video/thumbs/{{$video[0]->thumbnail}}" style="">
                        <source src="/video/{{$video[0]->filename}}" type="video/webm" />
                    </video>

                    <div class="ibox float-e-margins">
                        <div class="ibox-title clearfix">

                            <div class="pull-left">
                                <h1>{{ $video[0]->title }}</h1>
                                <h6>Tags:</h6>
                                <a href=""><span class="label">SOmething</span></a>
                                <a href=""><span class="label">SOm3thing totally different</span></a>
                            </div>

                            <div class="pull-right">
                                    <h2>867,537 views</h2>
                                    <div class="progress progress-mini" style="margin-bottom: 10px;">
                                        <div style="width: {{$video[0]->ratio}}%;" class="progress-bar"></div>
                                    </div>
                                    <button class="btn btn-white btn-outline" type="button" data-toggle="tooltip" data-placement="bottom" title="Like this"><i class="fa fa-thumbs-up"></i> {{$video[0]->likes}}</button>
                                    <button class="btn btn-white btn-outline" type="button" data-toggle="tooltip" data-placement="bottom" title="Dislike this"><i class="fa fa-thumbs-down"></i> {{$video[0]->dislikes}}</button>
                            </div>

                        </div>
                        <div class="ibox-content clearfix">
                            <p>{{$video[0]->description}}</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Related Videos</h2>
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
