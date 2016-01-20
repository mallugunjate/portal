    <!-- Mainly scripts -->
    <script src="/js/env.js"></script>
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/js/jquery-ui.custom.min.js"></script>

    <!-- Alerts -->
    <script src="/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="/js/custom/site/storeselector/storeSelector.js"></script>

    <script type="text/javascript">
    // Config box

    if (localStorageSupport) {
        var collapse = localStorage.getItem("collapse_menu");
        var fixedsidebar = localStorage.getItem("fixedsidebar");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var boxedlayout = localStorage.getItem("boxedlayout");
        var fixedfooter = localStorage.getItem("fixedfooter");

        if (collapse == 'on') {
            $('#collapsemenu').prop('checked','checked')
        }
        if (fixedsidebar == 'on') {
            $('#fixedsidebar').prop('checked','checked')
        }
        if (fixednavbar == 'on') {
            $('#fixednavbar').prop('checked','checked')
        }
        if (boxedlayout == 'on') {
            $('#boxedlayout').prop('checked','checked')
        }
        if (fixedfooter == 'on') {
            $('#fixedfooter').prop('checked','checked')
        }
    }

    </script>


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
        case "1": //sc
            loadjscssfile("/css/skins/sportchek/skin.css", "css");

            @if (Request::is( Request::segment(1) ))
            document.getElementById('page-wrapper').style.backgroundImage = 'url(/images/dashboard-banners/hockey.jpg)';
            @endif

            console.log("loading the SC css");
            break;
        case "2": //atmo
            loadjscssfile("/css/skins/atmosphere/skin.css", "css");
            
            @if (Request::is( Request::segment(1) ))
            document.getElementById('page-wrapper').style.backgroundImage = 'url(/images/dashboard-banners/atmo-bg.jpg)';
            @endif

            console.log("loading the ATMO css");
            break;

        default:
            console.log('no skin css loaded');
    }
    
    
    </script>