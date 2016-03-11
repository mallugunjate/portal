    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>

    <title> @yield('title') </title>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/fonts/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="/css/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/fullcalendar/fullcalendar.print.css" media='print'>

    <link rel="stylesheet" type="text/css" href="/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">

    @unless ( Request::is('admin') || Request::is('admin/*') )
    {!! $skin !!}
    @endunless



   
