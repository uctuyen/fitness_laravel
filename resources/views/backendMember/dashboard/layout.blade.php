<!DOCTYPE html>
<html>

<head>
    {{-- <base href="{{ config('app.url') }}"> --}}
    @include('backendMember.dashboard.component.head')
</head>

<body>
    <div id="wrapper">
        @include('backendMember.dashboard.component.sidebar')
        <div id="page-wrapper" class="gray-bg">
            @include('backendMember.dashboard.component.nav')
            @include($template)          
            @include('backendMember.dashboard.component.footer')
        </div>

    </div>
    @include('backendMember.dashboard.component.script')

   
</body>
</html>
