<!DOCTYPE html>
<html>

<head>
    @section('title', 'Calendar')
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

       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Workload Calendar</h2>
{{--                 <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/document">Documents</a></li>
                </ol> --}}
            </div>
            <div class="col-lg-2">

            </div>
        </div>


         <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                
                        <div class="ibox-content">
                            <div id="calendar"></div>                        
                        </div>

                    </div>
                </div>
         </div>
{{-- 
         @foreach($events as $event)
            {{ $event->id }} - {{ $event->banner }} - {{ $event->title }} - {{$event->start}}::{{$event->end}}<br />
         @endforeach 
--}}    

    @include('site.includes.footer')       

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    
    @include('site.includes.scripts')

    <script type="text/javascript" src="/js/plugins/fullcalendar/fullcalendar.min.js"></script>
    
    <script type="text/javascript">
    $(function() { // document ready

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth() + 1;
        var y = date.getFullYear();
        var today = y + "-" + m + "-" + d;

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: today,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            
            events: [
                @foreach($events as $event)
                {
                title: "{{ $event->title }}",
                start: "{{ $event->start }}",
                end: "{{ $event->end }}"
                },
                @endforeach
            ]
        });
    });
    </script>

    @include('site.includes.bugreport')

</body>
</html>                