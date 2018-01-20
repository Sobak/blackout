@extends('base')
@section('content')
<br><br>
<h2><font size="5">@lang('user.forgot_password.title')</font><br>{{ $servername }}</h2>
<form action="{{ route('user.forgot-password') }}" method="post">
    <table width="400">
        <tbody><tr>
            <td class="c"><b>@lang('user.forgot_password.form')</b></td>
        </tr><tr>
            <th>@lang('user.forgot_password.para')</th>
        </tr>
        <tr>
            <th>@lang('user.forgot_password.email'): <input type="text" name="email" /></th>
        </tr>
        <tr>
            {{ csrf_field() }}
            <th><input name="submit" type="submit" value="@lang('user.forgot_password.submit')"/></th>
        </tr>
    </table>
</form>
@endsection
