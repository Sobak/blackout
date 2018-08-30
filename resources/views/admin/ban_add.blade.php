@extends('base')
@section('content')
<br><br>
<h2>{{ trans("admin/ban.add.title") }}</h2>
<form action="{{ route('admin.ban') }}" method="post">
    {{ csrf_field() }}
    <table width="409">
        <tr>
            <td class="c" colspan="2">@lang('admin/ban.add.player')</td>
        </tr><tr>
            <th width="129">@lang('admin/ban.add.username')</th>
            <th width="268"><input name="name" type="text" size="25" /></th>
        </tr><tr>
            <th>@lang('admin/ban.add.reason')</th>
            <th><input name="why" type="text" value="" size="25" maxlength="50"></th>
        </tr><tr>
            <td class="c" colspan="2">@lang('admin/ban.add.duration')</td>
        </tr><tr>
            <th>@lang('admin/ban.add.days')</th>
            <th><input name="days" type="text" value="0" size="5" /></th>
        </tr><tr>
            <th>@lang('admin/ban.add.hours')</th>
            <th><input name="hour" type="text" value="0" size="5" /></th>
        </tr><tr>
            <th>@lang('admin/ban.add.minutes')</th>
            <th><input name="mins" type="text" value="0" size="5" /></th>
        </tr><tr>
            <th>@lang('admin/ban.add.seconds')</th>
            <th><input name="secs" type="text" value="0" size="5" /></th>
        </tr><tr>
            <th colspan="2"><input type="submit" value="@lang('admin/ban.add.submit')" /></th>
        </tr>
    </table>
</form>
@endsection