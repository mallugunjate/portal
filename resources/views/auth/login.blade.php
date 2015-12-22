<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E | Login</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.min.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><img src="/img/hive.png" /></h1>

            </div>
            <h3>Welcome to HIVE</h3>
            <p>          
                
            </p>
            <p>Login in.</p>

					<form class="m-t" role="form" method="POST" action="{{ url('/admin/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						

						<div class="form-group">
		                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required="">
		                </div>

		                <div class="form-group">
                    		<input type="password" class="form-control" placeholder="Password" name="password" required="">
                		</div>

                		 <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                		 <p><small><center>OR</center></small></p>

							<a href="/login/facebook"><button class="btn btn-success block full-width m-b btn-facebook btn-outline"><i class="fa fa-facebook"> </i> Login with Facebook</button></a>
							<a href="#"> <button class="btn btn-info block full-width m-b btn-facebook btn-outline"><i class="fa fa-twitter"> </i> Login with Twitter</button></a>
{{-- 						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div> --}}

						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">


								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
								
								
							</div>
						</div>
			 </form>
            <p class="m-t"> <small>&copy; FGL Sports Ltd 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/wireframes/js/jquery-2.1.1.js"></script>
    <script src="/wireframes/js/bootstrap.min.js"></script>

</body>

</html>

