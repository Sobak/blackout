<html>
<head>
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ skin_asset('style.css') }}" />
    <meta http-equiv="content-type" content="text/html; charset={{ $ENCODING or '' }}" />
    @stack('head_extras')
    <script type="text/javascript" src="{{ asset('scripts/overlib.js') }}"></script>
</head>
<body>
    {!! $menu or '' !!}

    @includeWhen($hasTopbar, 'partials.topbar')

    <center>@yield('content')</center>
</body>
</html>