@extends('base')
@section('content')
<br><br>
<table width="700">
    <tbody><tr>
        <td width="120px" class="c" align="left"><font size="2px">@lang('app.name')</font></td>
        <td width="580px" rowspan="2" class="c" align="right">
            <font size="2px">{{ trans('install.system-installation') }}</font><br />
            @lang('install.step') {{ $step }}
        </td>
    </tr>
    <tr>
        <th rowspan="4"><table border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="124" align="center">
                        <a href="{{ route('install') }}" accesskey="i">@lang('install.menu.intro')</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="{{ route('install.database') }}" accesskey="i">@lang('install.menu.install')</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="{{ route('index') }}" accesskey="b">@lang('install.menu.quit')</a>
                    </td>
                </tr>
            </table></th>
    </tr>
    <form action="{{ $form_action }}" method="post">
        @yield('body')
    </form>
</table>
@endsection