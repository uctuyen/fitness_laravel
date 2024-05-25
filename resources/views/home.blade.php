<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    <link href="{{ asset('/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/css/style.min.css') }}" rel="stylesheet">
    <style>
        .error {
            color: #fff;
            margin-top: 7px;
            display: block;
        }
    </style>
</head>

<body>
    <img src="{{ asset('frontend/img/banner.jpg') }}" alt="banner">
    <section class="section section-sign-up-form stripe-section mb-0 fadeIn"
        style="background-image: url('https://citigym.com.vn/themes/citigym/images/clubs/11.jpg'); margin-top: 30px;">
        <div class="stripe-vector-1"><img alt="Tập luyện tại hệ thống CITIGYM"
                src="https://citigym.com.vn/themes/citigym/images/svg/stripe-section-left.svg"></div>
        <div class="stripe-vector-2"><img alt="Tập luyện tại hệ thống CITIGYM"
                src="https://citigym.com.vn/themes/citigym/images/svg/stripe-section-right.svg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="text-center">
                        <div class="section-title light">Đăng ký tham quan câu lạc bộ</div>
                    </div>
                    <form method="POST" action="{{ route('web.register-customer') }}" accept-charset="UTF-8">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control control-light" placeholder="Họ và tên" value="{{ old('name')}}">
                                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="phone_number" class="form-control control-light" placeholder="Số điện thoại" value="{{ old('phone_number')}}">
                                    {!! $errors->first('phone_number', '<span class="error">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control control-light" placeholder="Email" value="{{ old('email')}}">
                                    {!! $errors->first('email', '<span class="error">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control control-light" placeholder="Địa chỉ" value="{{ old('address')}}">
                                    {!! $errors->first('address', '<span class="error">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btnSubmit btn btn-brand">Đăng ký ngay</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
