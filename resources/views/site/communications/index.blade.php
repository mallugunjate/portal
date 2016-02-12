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

            @include('site.communications.commsidebar')

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
                    All Messages <small>({{ $communicationCount }} unread)</small>
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
                        <i class="fa fa-envelope-o"></i>
                      <!--   <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> -->
                    </td>
                    @if( $communication->communication_type_id == "1")
                    <td class="mail-subject"><a href="communication/show/{{ $communication->id }}">{{ $communication->subject }}</a></td>
                    @else
                    <td class="mail-subject"><a href="communication/show/{{ $communication->id }}">{{ $communication->subject }}</a> <span class="label label-sm label-{!! $communication->label_colour !!}">{!! $communication->label_name !!}</span></td>
                    @endif
                    
                    <td class="mail-preview"><a href="communication/show/{{ $communication->id }}">{!! $communication->trunc !!}</a></td>
                    <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
                    <td class="text-right mail-date">{{ $communication->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $communication->since }} ago)</small></td>
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