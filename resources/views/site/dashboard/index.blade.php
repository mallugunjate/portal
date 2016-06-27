<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')

    <style>
    #page-wrapper{
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 1) 100%), url('/images/dashboard-banners/{{ $banner->background }}') no-repeat 0px 50px; 
        background-size: cover !important;
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

            <h1 style="color: #fff; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 0px; line-height: 50px;">{{ $banner->title }}</h1>
            <h1 style="color: #fff; font-size: 40px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Book;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 10px;">{{ $banner->subtitle }}</h1>


                <div class="row">
                    <div class="col-lg-8">
                        @if (count($features) > 0)
                        <div class="ibox float-e-margins">
                            
                            <div class="ibox-title">
                                <h2>Featured Content</h2>
                            </div>
                      
                            <div class="ibox-content clearfix">

                                @foreach($features as $feature)
                                   
                                        <div class="product-box">
                                            <a href="/{{ Request::segment(1) }}/feature/show/{{ $feature->id }}">
                                                <div class="image" style="background-image:url('/images/featured-covers/{{ $feature->thumbnail }}'); background-size: cover; background-position: 50%">
                                                    
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
                        @endif

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
                                                @if (count($quicklinks)>0)
                                                    @foreach($quicklinks as $ql)
                                                    <tr>
                                                        <td>{!! $ql !!}</td>
                                                    </tr>
          
                                                    @endforeach
                                                @endif
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

                                        @if (count($communications) > 0)

                                            @foreach($communications as $c)
                                                <div class="feed-element">
                                                    <div>
                                                        <small class="pull-right">{{ $c->since }} ago</small>
                                                        <strong><a class="trackclick" data-comm-id="{{ $c->id }}" href="/{{ Request::segment(1) }}/communication/show/{{ $c->id }}">{{ $c->subject }}</strong></a><br />
                                                        <small>{{ $c->prettyDate }}</small>
                                                        <div>{!! $c->trunc !!}</div>
                                                        <small class="text-muted"></small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else

                                             <div class="feed-element">
                                                    <div>
                                                        <h4>No Current Communications</h4>
                                                    </div>
                                            </div>
                                        @endif


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
                                        <h2>Recent Uploads</h2>
                                    </div>
                                    
                                    <div class="ibox-content" style="max-height: 550px; overflow: auto;">

                                        <div>
                                            <div class="feed-activity-list">

                                            @if(count($notifications)>0)

                                                @foreach($notifications as $n)
    
                                                <div class="feed-element">
                                                    
 
                                                    <div class="media-body">
                                                        <span class="pull-left" style="padding: 0px 10px 0px 0px;">
                                                            <h2 style="padding: 0; margin: 0;">{!! $n->linkedIcon !!}</h2>
                                                        </span>                                                    
                                                        <small class="pull-right" style="padding-left: 10px;">{{ $n->since }} ago</small>
                                                            <strong>{!! $n->link !!}</strong> was {{ $n->verb }} <strong><a href="/{{ Request::segment(1) }}/document#!/{{ $n->global_folder_id }}">{{ $n->folder_name}}</a></strong>
                                                            @if($n->count > 1)
                                                            with <strong>{!! $n->count -1 !!}</strong> other documents
                                                            @endif
                                                    </div>
                                                    

                                                </div>

                                                @endforeach
                                                
                                            @endif

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
    @include('site.includes.modal')

    <script>
        console.frog("Ribbit");
    </script>
</body>
</html> 

