<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript">

        // function getQueryParams(qs) {
        //     qs = qs.split('+').join(' ');
        //     var params = {},
        //         tokens,
        //         re = /[?&]?([^=]+)=([^&]*)/g;
        //     while (tokens = re.exec(qs)) {
        //         params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
        //     }
        //     return params;
        // }
        //
        // var query = getQueryParams(document.location.search);
        // var element = document.getElementById("pdfcontainer");
        // element.setAttribute("data", query.file);

        // $(window).bind("load", function() {
        //     window.print();
        // });

        // $(window).load(function() {
        //     setTimeout(function(){
        //         //window.print();
        //         $('#print').trigger('click');
        //         console.log("clicked...");
        //     }, 3000);
        //
        // });

        // var items = $('object');
        // var itemslen = items.length;
        //
        // console.log("breofore bind: "+itemslen);
        //
        // items.bind('load', function(){
        //     itemslen--;
        //     console.log("after bind: " +itemslen);
        //     if (!itemlen){
        //         window.print();
        //     }
        // });

        //window.onload = function () {
        // $(window).load(function(){
        //
        //
        // });


        // var chkReadyState = setInterval(function() {
        //     console.log(document.readyState);
        //     if (document.readyState == "complete") {
        //         // clear the interval
        //         clearInterval(chkReadyState);
        //
        //         window.print();
        //     }
        // }, 100);



        </script>
    </head>
    <body>

        <object style="margin: 0; padding: 0; position: absolute; top: 0px; left: 0px; height: 100%; width: 100%;" id="pdfcontainer" data="<?php echo($_REQUEST['file']); ?>" type="application/pdf" width="100%" height="100%"></object>



    </body>
</html>
