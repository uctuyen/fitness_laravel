<!DOCTYPE html>
<html>

<head>
    {{-- <base href="{{ config('app.url') }}"> --}}
    @include('backendTrainer.dashboard.component.head')
</head>

<body>
    <div id="wrapper">
        @include('backendTrainer.dashboard.component.sidebar')
        <div id="page-wrapper" class="gray-bg">
            @include('backendTrainer.dashboard.component.nav')
            @include($template)          
            @include('backendTrainer.dashboard.component.footer')
        </div>

    </div>
    @include('backendTrainer.dashboard.component.script')

   
</body>
</html>
