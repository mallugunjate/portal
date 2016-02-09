<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <head>
        <?php 
        $skin=""; 
        $dir = "../public/images/bloopers/";
        $images = scandir($dir);
        $i = rand(2, sizeof($images)-1);
        ?>
        @section('title', '404')
        @include('site.includes.head')
    </head> 

    <body class="gray-bg">

    <div class="middle-box text-center animated fadeInDown">
        <h1>NOPE</h1>
        <h3 class="font-bold">This is what we call a 404 error, folks.</h3>

        



        <div class="error-desc">
            <p>You've typed something wrong, or we've linked something wrong. <br />Either way, this is a <strong>fail</strong>.</p>
            <img src="/images/bloopers/<?php echo $images[$i]; ?>" alt="" />
        </div>

<!--             <form class="form-inline m-t" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search for page">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form> -->
        
        <p>
            <h3>We Sugguest...</h3>
            <a href="/">Go to the Home Page</a><br />
            <a href="#" onclick="history.go(-1);">Go back to the page you just came from</a>
        </p>

    </div>



    
    </body>

</html>