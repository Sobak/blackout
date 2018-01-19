@extends('install.base')
@section('body')
<tr>
    <th colspan="2">
        <br>{{ session('error') }}<br>
        @lang('install.database.para1')<br>
        @lang('install.database.para2')<br>
        <br><br>
        <table width="270" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td>@lang('install.database.form.host'):</td>
                <td><input type="text" name="host" value="localhost" size="20"></td>
            </tr>
            <tr>
                <td>@lang('install.database.form.database'):</td>
                <td><input type="text" name="database" value="" size="20"></td>
            </tr>
            <tr>
                <td>@lang('install.database.form.prefix'):</td>
                <td><input type="text" name="prefix" value="game_" size="20"></td>
            </tr>
            <tr>
                <td>@lang('install.database.form.username'):</td>
                <td><input type="text" name="username" value="" size="20"></td>
            </tr>
            <tr>
                <td>@lang('install.database.form.password'):</td>
                <td><input type="password" name="password" value="" size="20"></td>
            </tr>
        </table>
        <br>
    </th>
</tr>
<tr>
    {{ csrf_field() }}
    <th colspan="2"><input type="button" name="next" onclick="submit();" value="@lang('install.database.install')"></th>
</tr>
@endsection