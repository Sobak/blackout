@extends('install.base')
@section('body')
<tr>
    <th colspan="2">
        <br>@lang('install.account.done.para1')<br>
        @lang('install.account.done.para2')<br><br>
    </th>
</tr>
<tr>
    <th colspan="2"><input type="button" name="next" onclick="self.location.href='../'" value="@lang('install.account.done.log_in')"></th>
</tr>
@endsection