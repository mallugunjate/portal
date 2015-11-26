<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E | Register</title>

    <link href="/wireframes/css/bootstrap.min.css" rel="stylesheet">
    <link href="/wireframes/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/wireframes/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/wireframes/css/animate.css" rel="stylesheet">
    <link href="/wireframes/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">E</h1>

            </div>
            <h3>Sign Up for E</h3>
            <p>Create an account.</p>
            <form class="m-t" role="form" action="login.html">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" required="">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="">
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Sign Up</button>

                <hr />
                <p><small><center>OR</center></small></p>
                <h3>Sign up using a social media account</h3> 
                <p><small><a href="#">What does this mean?</a></small></p>
                
                <button class="btn btn-success block full-width m-b btn-facebook btn-outline"><i class="fa fa-facebook"> </i> Sign up using Facebook</button>
                <button class="btn btn-info block full-width m-b btn-facebook btn-outline"><i class="fa fa-twitter"> </i> Sign up using Twitter</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="/wireframe/login">Login</a>
            </form>
            <p class="m-t"> <small>&copy; FGL Sports Ltd 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/wireframes/js/jquery-2.1.1.js"></script>
    <script src="/wireframes/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="/wireframes/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
