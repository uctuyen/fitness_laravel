<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer</title>

    <link href="/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/backend/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/backend/css/animate.css" rel="stylesheet">
    <link href="/backend/css/style.css" rel="stylesheet">
    <link href="/backend/css/customize.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>Welcome to IN+</h3>
            <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
            <div class="col-md-6">
                <div class="ibox-content">

                    <form method="post" class="m-t" role="form" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="form-group">
                            <input name="email" type="text" class="form-control" placeholder="Email"
                                value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="error-message">*{{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="error-message">*{{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary block full-width m-b">Đăng nhập</button>

                        <a href="#">
                            <small>Forgot password?</small>
                        </a>
                    </form>
                    <p class="m-t">
                        <small> Tuyen Project &copy; 2024</small>
                    </p>
                </div>
            </div>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>

</html>
