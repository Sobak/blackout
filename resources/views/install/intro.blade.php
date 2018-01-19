@extends('install.base')
@section('body')
<tr>
    <th colspan="2">
        <br>@lang('install.intro.head')<br>
        @lang('install.intro.para1')<br>
        @lang('install.intro.para2')<br>
        @lang('install.intro.para3')<br><br>
    </th>
</tr>
<tr>
    <th colspan="2"><input type="button" name="next" onclick="self.location.href='{{ route('install.database') }}'" value="@lang('install.next')" ></th>
</tr>
@endsection