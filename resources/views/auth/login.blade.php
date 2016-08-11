<!DOCTYPE html>
<html>

<head>
    @section('title', 'Admin Login')
    @include('site.includes.head')
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <p>&nbsp;</p>
                <img src="/images/fgl.png" />
            </div>
{{--
            <h3>Welcome to the Store Operations Portal</h3> --}}
            <p>
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            {{-- <p>Admin Login</p> --}}

            <p>&nbsp;</p>
            <form class="m-t" role="form" method="POST" action="{{ url('/admin/login') }}" autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required="" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="{{ url('/password/email') }}"><small>Forgot password?</small></a>
{{--                 <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> --}}
            </form>

        </div>
    </div>


    <!-- Mainly scripts -->
    <script src="/wireframes/js/jquery-2.1.1.js"></script>
    <script src="/wireframes/js/bootstrap.min.js"></script>

</body>

</html>
