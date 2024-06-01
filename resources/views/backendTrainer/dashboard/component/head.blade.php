<base href="{{env('APP_URL')}}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Trainer</title> 
<link href="{{ asset('/backend/css/bootstrap.min.css') }}   " rel="stylesheet">
<link href="{{ asset('/backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

<link href="{{ asset('/backend/css/animate.css') }}" rel="stylesheet">
@if(isset($config['css']) && is_array($config['css']) );
        @foreach ($config['css'] as $key => $val)
                <link  rel="stylesheet" href="{{ asset($val) }}">
        @endforeach
@endif
<link href="{{ asset('/backend/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/backend/css/customize.css') }}" rel="stylesheet">
<script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">{{-- <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
<script src="{{ asset('/backend/js/script.js') }}"></script> --}}

