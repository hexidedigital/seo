<html>
<head>
    {!! Meta::getMetaView() !!}
    <link href="{{asset('seo/css/app.css')}}" rel="stylesheet">
    @vite('resources/js/app.js')  {{--TODO: REMOVE ME--}}
</head>
<body>
    @yield('content')
</body>

</html>
