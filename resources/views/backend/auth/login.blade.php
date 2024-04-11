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

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to Fitness Project</h2>

                <p>
                   <img src="https://t4.ftcdn.net/jpg/04/15/32/43/360_F_415324398_W9kQKIx3xp1tH5p7RXQNChtATIH1Szyp.jpg" 
                   style="width: 50%; text-align-certer"
                   alt="">
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    
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
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2024-2025</small>
            </div>
        </div>
    </div>

</body>

</html>
