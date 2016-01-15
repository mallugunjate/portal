    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> @yield('title') </title>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/fonts/font-awesome/css/font-awesome.css">

    <!-- Morris -->
{{--     <link rel="stylesheet" type="text/css" href="/css/plugins/morris/morris-0.4.3.min.css"> --}}

    <link rel="stylesheet" type="text/css" href="/css/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/fullcalendar/fullcalendar.print.css" media='print'>

    <link rel="stylesheet" type="text/css" href="/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">

   
    <script type="text/javascript">

    function loadjscssfile(filename, filetype){
        if (filetype=="js"){ //if filename is a external JavaScript file
            var fileref=document.createElement('script')
            fileref.setAttribute("type","text/javascript")
            fileref.setAttribute("src", filename)
        }
        else if (filetype=="css"){ //if filename is an external CSS file
            var fileref=document.createElement("link")
            fileref.setAttribute("rel", "stylesheet")
            fileref.setAttribute("type", "text/css")
            fileref.setAttribute("href", filename)
        }
        if (typeof fileref!="undefined")
            document.getElementsByTagName("head")[0].appendChild(fileref)
    }

    var banner = localStorage.getItem('userBanner');
    console.log(banner);

    switch (banner) {
        case "1":
            loadjscssfile("/css/skins/sportchek/skin.css", "css");
            console.log("loading the SC css");
            break;
        case "2":
            loadjscssfile("/css/skins/atmosphere/skin.css", "css");
            console.log("loading the ATMO css");
            break;

        default:
            console.log('no skin css loaded');
    }
    
    </script>