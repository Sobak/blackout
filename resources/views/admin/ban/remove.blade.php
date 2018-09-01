@extends('base')
@section('content')
<br><br>
<h2>{{ trans("admin/ban.remove.title") }}</h2>
<form action="{{ route('admin.unban') }}" method="post">
    {{ csrf_field() }}
    <table width="409" style="color:#FFFFFF">
        <tbody>
        <tr>
            <td class="c" colspan="2">@lang('admin/ban.remove.player')</td>
        </tr>
        <tr>
            <th width="129">@lang('admin/ban.remove.username')</th>
            <th width="268"><input name="nam" maxlength="80" size="25" value="" type="text">
            </th>
        </tr>
        <tr>
            <th colspan="2"><input value="@lang('admin/ban.remove.submit')" type="submit"></th>
        </tr>
        <tr>
        </tr>
        </tbody>
    </table>
</form>
@endsection