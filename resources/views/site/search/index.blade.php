<!DOCTYPE html>
<html>

<head>
    @section('title', 'Search: '. $query)
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')

    <style>

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


        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Search results for: <span class="search-query">{{ $query }}</span></h2>
<!--                 <ol class="breadcrumb">
                    <li>jdaf ja fl aslk salk adslkd aslkdsa lksad</li>
                </ol> -->
            </div>
            
        </div>            



            <div class="wrapper wrapper-content">

                <div class="row">


                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Documents <small>{{ count($docs) }} results</small></h2>
                        </div>

                        @if( count($docs) > 0)
                        <div class="mail-box">

                            <table class="table tablesorter table-hover table-mail tablesorter-default" id="file-table" role="grid">
                                <thead>
                                    <tr> 
                                        <th> Title </th> 
                                        <th> Description </th> 
                                        <th> Last Updated </th> 
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($docs as $doc)
                                    <tr> 
                                        <td class="mail-subject">{!! $doc->modalLink !!}</td> 
                                        <td>{{ $doc->description }}</td> 
                                        <td>{{ $doc->since }} ago</td> 
                                        <td></td> 
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div>


                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Alerts <small>{{ count($alerts) }} results</small></h2>
                        </div>


                        @if( count($alerts) > 0)
                        <div class="mail-box">

                            <table class="table tablesorter table-hover table-mail tablesorter-default" id="file-table" role="grid">
                                <thead>
                                    <tr> 
                                        <th> Title </th> 
<!--                                         <th> Description </th>  -->
                                        <th> Active Since </th> 
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($alerts as $alert)
                                    <tr> 
                                        <td class="mail-subject">{!! $alert->modalLink !!}</td> 
<!--                                         <td>{{ $alert->description }}</td>  -->
                                        <td>{{ $alert->since }} ago</td> 
                                        <td></td> 
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div>                 


                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Folders <small>{{ count($folders) }} results</small></h2>
                        </div>
                        @if( count($folders) > 0)
                        <div class="mail-box">

                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> Folder </th> 
                                        <th> Path </th> 
                                        <th> Last Updated </th> 
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($folders as $folder)
                                    <tr>
                                        <td class="check-mail"><i class="fa fa-folder-open"></i></td>
                                        <td class="mail-subject"><a href="/{{ Request::segment(1) }}/document#!/{{ $folder->globalId }}">{{ $folder->name }}</a></td>
                                        <td>{!! $folder->path !!}</td>                 
                                        <td class="mail-date">{{ $folder->lastActivity }} ago</td>
                                    </tr>                
                                @endforeach
                                                 
                                </tbody>
                            </table>


                        </div>
                        @endif
                    </div>

                </div>                
           

                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Communications <small>{{ count($communications) }} results</small></h2>
                        </div>
                        @if( count($communications) > 0)
                        <div class="mail-box">


                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr> 
                                        <th></th>
                                        <th> Subject </th> 
                                        <th>  </th> 
                                        <th> Posted </th> 
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($communications as $comm)
                                    <tr>
                                        <td class="check-mail"><i class="fa fa-envelope-o"></i></td>
                                        <td class="mail-subject"><a href="/{{ Request::segment(1) }}/communication/show/{{ $comm->communication_id }}">{{ $comm->subject }}</a></td>
                                        <td>{{ $comm->trunc }}</td>
                                        <td>{{ $comm->since }} ago</td>
                                    </tr>                
                                    @endforeach
                                                 
                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div> 

   

                            

                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')       
    @include('site.includes.scripts')
    @include('site.includes.bugreport')
    @include('site.includes.modal')


</body>
</html> 

