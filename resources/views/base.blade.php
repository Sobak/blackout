<html>
<head>
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ skin_asset('default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ skin_asset('formate.css') }}" />
    <meta http-equiv="content-type" content="text/html; charset={{ $ENCODING or '' }}" />
    @stack('head_extras')
    <script type="text/javascript" src="{{ asset('scripts/overlib.js') }}"></script>
</head>
<body>
    {!! $menu or '' !!}

    <center>@yield('content')</center>
</body>
</html>