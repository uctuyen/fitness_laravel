<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin</title>

    <link href="/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/backend/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/backend/css/animate.css" rel="stylesheet">
    <link href="/backend/css/style.css" rel="stylesheet">
    <link href="/backend/css/customize.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-1 d-flex flex-column justify-content-center align-items-center">
                <div style="display: grid; grid-template-columns: 1fr; grid-gap: 10px;">
                    <h1 class="logo-name" style="font-size: 2em; color: red;">E</h1>
                    <h1 class="logo-name" style="font-size: 2em; color: orange;">P</h1>
                    <h1 class="logo-name" style="font-size: 2em; color: yellow;">L</h1>
                    <h1 class="logo-name" style="font-size: 2em; color: green;">O</h1>
                    <h1 class="logo-name" style="font-size: 2em; color: blue;">Y</h1>
                    <h1 class="logo-name" style="font-size: 2em; color: indigo;">E</h1>
                    <h1 class="logo-name" style="font-size: 2em; color: violet;">E</h1>
                </div>  
            </div>
            <div class="col-md-5 d-flex justify-content-center align-items-center" style="padding-right: 0;">
                <img src="/frontend/img/admin-login2.jpg" style="width: 100%" alt="">
            </div>
            <div class="col-md-6" style="padding-left: 0;">
                <div class="ibox-content">
                   <img src="https://t4.ftcdn.net/jpg/04/15/32/43/360_F_415324398_W9kQKIx3xp1tH5p7RXQNChtATIH1Szyp.jpg" 
                   style="width: 100%; text-align-certer"
                   alt="">
                    <form method="post" class="m-t" role="form" action="{{route('auth.login')}}">
                        @csrf
                        <div class="form-group">
                            <input name="email" 
                            type="text" 
                            class="form-control" 
                            placeholder="Email"
                            value="{{old('email')}}"
                            >
                            
                            @if ($errors->has('email'))
                                <span class="error-message">*{{
                                    $errors->first('email')
                                    }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input name="password" 
                            type="password" 
                            class="form-control" 
                            placeholder="Password" 
                            >

                        @if ($errors->has('password'))
                            <span class="error-message">*{{
                                $errors->first('password')
                                }}
                            </span>
                        @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary block full-width m-b">Đăng nhập</button>

                    </form>
                    <p class="m-t">
                        <small> Tuyen Project &copy; 2024</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Uc Tuyen
            </div>
            <div class="col-md-6 text-right">
               <small>© 2023-2024</small>
            </div>
        </div>
    </div>

</body>

</html>
