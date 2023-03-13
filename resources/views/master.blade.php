<html>
<head>
    {!! Meta::getMetaView() !!}
    <link href="{{asset('seo/css/app.css')}}" rel="stylesheet">
    <script src="{{asset('seo/js/app.js')}}"></script>
</head>
<body>
    @yield('content')
</body>

</html>
