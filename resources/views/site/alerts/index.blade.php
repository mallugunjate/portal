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

            @include('site.alerts.alertssidebar')

            </div>
            <div class="col-lg-10 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
                    All Alerts <small>({{ $alertCount }} unread)</small>
                </h2>

            </div>
                <div class="mail-box">


                <table class="table table-hover table-mail">
                <tbody>

                @foreach($alerts as $alert)
                
                @if( $alert->is_read == 1)
                <tr class="read">
                @else
                <tr class="unread">
                @endif

                    <td class="check-mail">
                        <i class="fa fa-envelope-o"></i>
                      <!--   <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> -->
                    </td>
                    @if( $alert->alert_type_id == "1")
                    <td class="mail-subject"><a href="alerts/show/{{ $alert->id }}">{{ $alert->subject }}</a></td>
                    @else
                    <td class="mail-subject"><a href="alerts/show/{{ $alert->id }}">{{ $alert->subject }}</a> <span class="label label-sm label-danger">Some alert type</span></td>
                    @endif
                    
                    <td class="mail-preview"><a href="alerts/show/{{ $alert->id }}"></a></td>
                    <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
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