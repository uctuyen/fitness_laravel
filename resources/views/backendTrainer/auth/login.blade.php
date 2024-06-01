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
    <div class="middle-box text-center loginscreen animated fadeInDown" style="width: 516px; display: flex; flex-direction: column; align-items: center;">
        <div>
            <div>
                <h1 class="logo-name">Trainer</h1>
            </div>
            <div class="col-md-12">
                <div class="ibox-content">
                    <img src="/frontend/img/trainer-login.jpg" style="width: 50%" alt="">
                    <form method="post" class="m-t" role="form" action="{{ route('trainer.login') }}">
                        @csrf
                        <div class="form-group">
                            <input name="email" 
                            type="text" 
                            class="form-control" 
                            placeholder="Email"
                            value="{{ old('email') }}"
                            >
                            @if ($errors->has('email'))
                                <span class="error-message" style="display: block;">*{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input name="password" 
                            type="password" 
                            class="form-control" 
                            placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="error-message" style="display: block;">*{{ $errors->first('password') }}</span>
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
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="/backend/js/jquery-3.1.1.min.js"></script>
    <script src="/backend/js/bootstrap.min.js"></script>
    </body>
</html>