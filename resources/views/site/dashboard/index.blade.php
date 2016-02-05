<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')

    <style>
    #page-wrapper{
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 1) 100%), url('/images/dashboard-banners/{{ $banner->background }}') no-repeat 0px 50px; 
        background-size: cover;
        overflow: hidden;
    }

    #footer{
        position: fixed;
        bottom: 0px;
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

            <h1 style="color: #fff; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 0px; line-height: 50px;">Banner Name</h1>
            <h1 style="color: #fff; font-size: 40px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Book;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 10px;">This is the Sub Title</h1>


                <div class="row">
                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Featured Content</h2>
                            </div>
                      
                            <div class="ibox-content clearfix">


                            @foreach($features as $feature)
                               
                                    <div class="product-box">
                                        <a href="/{{ Request::segment(1) }}/feature/show/{{ $feature->id }}">
                                            <div class="image" style="background-image:url('/images/featured-covers/{{ $feature->thumbnail }}'); background-size: cover; background-position: 50%">
                                                {{-- <img alt="image" class="img-responsive" src="> --}}
                                            </div>
                                            <div class="product-desc">
                                                <span class="product-price">
                                                {{ $feature->title }}
                                                </span>
                                               
                                            </div>
                                        </a>
                                    </div>
                            
                            @endforeach

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h2>Quick Links</h2>
                                    </div>
                              
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>

                                                @foreach($quicklinks as $ql)
                                                <tr>
                                                    {{-- <a data-toggle="tab" href="#contact-1" class="client-link"><i class="fa fa-external-link"></i>  Visit The North Face Website</a> --}}
                                                    <td>{!! $ql !!}</td>
                                                    
                                                </tr>
      
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                              
                            </div>

                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h2>Latest Communications</h2>
                                    </div>
                              
                                    <div class="ibox-content">
                                        <div class="feed-activity-list">

                                        @foreach($communications as $c)
                                            <div class="feed-element">
                                                <div>
                                                    <small class="pull-right">{{ $c->since }} ago</small>
                                                    <strong><a href="/{{ Request::segment(1) }}/communication/show/{{ $c->id }}">{{ $c->subject }}</strong></a><br />
                                                    <small>{{ $c->prettyDate }}</small>
                                                    <div>{!! $c->trunc !!}</div>
                                                    <small class="text-muted"></small>
                                                </div>
                                            </div>
                                        @endforeach

{{--                                             <div class="feed-element">
                                                <div>
                                                    <small class="pull-right">1m ago</small>
                                                    <strong>Get Ready for Hockey Plus</strong>
                                                    <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
                                                    <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                                                </div>
                                            </div>

                                            <div class="feed-element">
                                                <div>
                                                    <small class="pull-right">2m ago</small>
                                                    <strong>Back to School Primer</strong>
                                                    <div>There are many variations of passages of Lorem Ipsum available</div>
                                                    <small class="text-muted">Today 2:23 pm - 11.06.2014</small>
                                                </div>
                                            </div>

                                            <div class="feed-element">
                                                <div>
                                                    <small class="pull-right">5m ago</small>
                                                    <strong>Information on New Accessories Fixtures</strong>
                                                    <div>Contrary to popular belief, Lorem Ipsum</div>
                                                    <small class="text-muted">Today 1:00 pm - 08.06.2014</small>
                                                </div>
                                            </div>

                                            <div class="feed-element">
                                                <div>
                                                    <small class="pull-right">5m ago</small>
                                                    <strong>Jumpstart Update for March 2016</strong>
                                                    <div>The generated Lorem Ipsum is therefore </div>
                                                    <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                                </div>
                                            </div> --}}


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

                                        <div>
                                            <div class="feed-activity-list">


                                                @foreach($notifications as $n)

                                                <?php
                                                    $icon ="";
                                                    switch($n->original_extension){
                                                        case "mp4":
                                                            $icon ="fa-film";
                                                            break;
                                                        case "pdf":
                                                            $icon  = "fa-file-pdf-o";
                                                            break;
                                                        case "xls":
                                                        case "xlsx":
                                                        case "xlsm":
                                                            $icon = "fa-file-excel-o";
                                                            break;
                                                        case "jpg":
                                                        case "png":
                                                        case "bmp":
                                                        case "gif":
                                                        case "psd":
                                                            $icon = "fa-file-image-o";
                                                            break;
                                                        default:
                                                            $icon = "fa-file-o";
                                                            break;
                                                    }
                                                ?>
                                                <div class="feed-element">
                                                    <span class="pull-left">
                                                        <h1><i class="fa {{ $icon }}"></i></h1>
                                                    </span>
                                                    <div class="media-body ">
                                                        <small class="pull-right">{{ $n->since }} ago</small>
                                                        <strong><a href="{{ $n->filename }}">{{ $n->title }}</a></strong> was {{ $n->verb }} <strong><a href="{{ $n->global_folder_id }}">{{ $n->folder_name}}</a></strong>. <br>
                                                        <small class="text-muted">{{ $n->prettyDate }}</small>

                                                    </div>
                                                </div>
                                                @endforeach




{{--                                                 <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">2 days ago at 8:30am</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">5h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>

                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">23h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                       <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">46h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                    </div>
                                                </div>

                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">46h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                    </div>
                                                </div>

                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">46h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                    </div>
                                                </div> --}}
                                            </div>

                                           {{--  <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</button> --}}

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
    @include('site.includes.bugreport')

</body>
</html> 