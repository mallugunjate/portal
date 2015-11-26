<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FGL HIVE | Register</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css">


</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><img src="/img/hive.png" /></h1>

            </div>
            <h3>Sign Up for HIVE</h3>
            <p>Create an account.</p>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

					<form class="m-t" role="form" method="POST" action="{{ url('/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input type="text" class="form-control" name="firstname" placeholder="First Name" value="{{ old('firstname') }}" required="">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}" required="">
                        </div>                        

                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') }}" required="">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="store" name="store" placeholder="Store" value="{{ old('store') }}" required=""> 
                        </div>  


						<!-- <div class="form-group">
							<label class="col-md-4 control-label" for="position">Position</label>
							<div class="col-md-6">

							</div>
						</div>
 -->

                         <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" required="" name="password">
                        </div>

                         <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required="">
                        </div>

                        <button type="submit" class="btn btn-primary block full-width m-b">Sign Up</button>

                        <hr />

                        <p><small><center>OR</center></small></p>
                        <h3>Sign up using a social media account</h3> 
                        <p><small><a data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">What does this mean?</a></small></p>
                        
                        <button class="btn btn-success block full-width m-b btn-facebook btn-outline"><i class="fa fa-facebook"> </i> Sign up using Facebook</button>
                        <button class="btn btn-info block full-width m-b btn-facebook btn-outline"><i class="fa fa-twitter"> </i> Sign up using Twitter</button>

                        <p class="text-muted text-center"><small>Already have an account?</small></p>
                        <a class="btn btn-sm btn-white btn-block" href="/wireframe/login">Login</a>                        
                    </form>
            <p class="m-t"> <small>&copy; FGL Sports Ltd 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.js"></script>
    <!-- iCheck -->
    <script src="/js/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src= "/js/jquery-ui-1.10.4.min.js"></script>

    <script>
        $(document).ready(function(){

            var stores = <?php echo $storeobj_list ?>;
            $(function () {
              $('[data-toggle="popover"]').popover()
            })
            
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $("#store").autocomplete({
                source : stores
            })
        });
    </script>
</body>

</html>

