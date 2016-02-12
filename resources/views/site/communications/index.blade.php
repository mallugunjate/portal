<!DOCTYPE html>
<html>

<head>
    @section('title', 'Communications')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')
    
</head>	

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav');
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            {{-- <a class="btn btn-block btn-primary compose-mail" href="mail_compose.html">Compose Mail</a> --}}
                            <div class="space-25"></div>
                            {{-- <h5>Folders</h5> --}}
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li>
                                    <a href="/{{ Request::segment(1) }}/communication"> <i class="fa fa-inbox "></i> All Messages 
                                    @if($communicationCount > 0)
                                    <span class="label label-inverse pull-right">{{ $communicationCount }}</span> 
                                    @endif
                                    </a>
                                </li>
{{--                                 <li><a href="mailbox.html"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                                <li><a href="mailbox.html"> <i class="fa fa-certificate"></i> Important</a></li> --}}
{{--                                 <li><a href="mailbox.html"> <i class="fa fa-file-text-o"></i> Drafts <span class="label label-danger pull-right">2</span></a></li>
                                <li><a href="mailbox.html"> <i class="fa fa-trash-o"></i> Trash</a></li> --}}
                            </ul>
                            <h5>Categories</h5>
                            <ul class="category-list" style="padding: 0">
                            @foreach($communicationTypes as $c)

                                <li><a href="#"> <span class="label label-{{ $c->colour }} pull-right">{{ $c->count }}</span> {{ $c->communication_type }}</a></li>

                            @endforeach
                            </ul>
                                
{{--                            <li><a href="#"> <i class="fa fa-circle text-danger"></i> Documents</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-primary"></i> Social</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-info"></i> Advertising</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-warning"></i> Clients</a></li> --}}
                            

{{--                             <h5 class="tag-title">Labels</h5>
                            <ul class="tag-list" style="padding: 0">
                                <li><a href=""><i class="fa fa-tag"></i> Family</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Work</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Home</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Children</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Holidays</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Music</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Photography</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Film</a></li>
                            </ul> --}}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 animated fadeInRight">
            <div class="mail-box-header">

{{--                 <form method="get" action="index.html" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="search" placeholder="Search email">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form> --}}
                <h2>
                    All Messages <small>({{ count($communications) }} unread)</small>
                </h2>

            </div>
                <div class="mail-box">


                <table class="table table-hover table-mail">
                <tbody>

                @foreach($communications as $communication)
                
                @if( $communication->is_read == 1)
                <tr class="read">
                @else
                <tr class="unread">
                @endif

                    <td class="check-mail">
                        <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                    </td>
                    <td class="mail-subject"><a href="communication/show/{{ $communication->id }}">{{ $communication->subject }}</a> <span class="label label-sm label-{!! $communication->label_colour !!}">{!! $communication->label_name !!}</span></td>
                    <td class="mail-subject"><a href="communication/show/{{ $communication->id }}">{!! $communication->trunc !!}</a></td>
                    <td class=""><i class="fa fa-paperclip"></i></td>
                    <td class="text-right mail-date">{{ $communication->send_at }}</td>
                </tr>                

                @endforeach
                 
                </tbody>
                </table>


                </div>
            </div>
        </div>
        </div>



    @include('site.includes.footer')       

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
  
    @include('site.includes.scripts')
    <script src="/js/plugins/iCheck/icheck.min.js"></script>
 
	<script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    @include('site.includes.bugreport')

</body>
</html> 