@extends('install.base')
@section('body')
<tr>
    <th colspan="2">
        <br>@lang('install.account.para1')<br>
        @lang('install.account.para2')<br><br>
        <table width="270" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td>@lang('install.account.form.username'):</td>
                <td><input name="username" size="20" maxlength="20" type="text" onKeypress="
                if (event.keyCode==60 || event.keyCode==62) event.returnValue = false;
                if (event.which==60 || event.which==62) return false;"></td>
            </tr>
            <tr>
                <td>@lang('install.account.form.password'):</td>
                <td><input name="password" size="20" maxlength="20" type="password" onKeypress="
                 if (event.keyCode==60 || event.keyCode==62) event.returnValue = false;
                 if (event.which==60 || event.which==62) return false;"></td>
            </tr>
            <tr>
                <td>@lang('install.account.form.email'):</td>
                <td><input name="email" size="20" maxlength="40" type="text" onKeypress="
                 if (event.keyCode==60 || event.keyCode==62) event.returnValue = false;
                 if (event.which==60 || event.which==62) return false;"></td>
            </tr>
            <tr>
                <td>@lang('install.account.form.planet'):</td>
                <td><input name="planet" size="20" maxlength="20" type="text" onKeypress="
                 if (event.keyCode==60 || event.keyCode==62) event.returnValue = false;
                 if (event.which==60 || event.which==62) return false;"></td>
            </tr>
        </table>
        <br>
    </th>
</tr>
<tr>
    {{ csrf_field() }}
    <th colspan="2"><input type="button" name="next" onclick="submit();" value="@lang('install.account.create')"></th>
</tr>
@endsection