<!DOCTYPE html>
<html>

<head>
    @section('title', 'alerts')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')
    
</head>	

<body class="fixed-navigation">
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

            @include('site.alerts.alertssidebar')

            </div>
            <div class="col-lg-10 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
                	@if($title == "")
                		All Alerts <small>( {{ $alertCount }} active alert)</small>	
                	@else
                		{{ $title }}
                	@endif

                    
                </h2>

            </div>
                <div class="mail-box">


                <table class="table table-hover table-mail">
                <tbody>

                @foreach($alerts as $alert)
                

                <tr class="unread">

                    <td class="check-mail">
                        <i class="fa fa-bell-o"></i>
                    </td>
                    
                    <td class="mail-subject"><a href="/files/{{ $alert->filename }}">{!! $alert->icon !!} {{ $alert->title }}</a> <span class="label label pull-right">{{ $alert->alertTypeName }}</span></td>
                    <td class="mail-preview"><a href="/files/{{ $alert->filename }}">{{ $alert->description }}</a></td>
                    <td class=""></td>
                    <td class="text-right mail-date">{{ $alert->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $alert->since }} ago)</small></td>
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