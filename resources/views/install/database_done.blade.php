@extends('install.base')
@section('body')
<tr>
    <th colspan="2">
        <br><br>@lang('install.database.done')<br><br>
    </th>
</tr>
<tr>
    <th colspan="2"><input type="button" name="next" onclick="self.location.href='{{ route('install.account') }}'" value="@lang('install.next')"></th>
</tr>
@endsection