@extends('base')
@section('content')
    <br><br>
    <h2>@lang('admin/overview.index.title')</h2>
    <table width="600">
        <tr>
            <td class="c" colspan="2">@lang('admin/overview.index.status')</td>
        </tr><tr>
            <td class="b" style="color:#FFFFFF">@lang('admin/overview.index.your_version'): <strong>{!! $version !!}</strong></td>
            <td class="b" style="color:#FFFFFF">@lang('admin/overview.index.check_version'): <b><a style="color:orange;" href="https://github.com/Sobak/blackout">@lang('admin/overview.index.here')</a></b></td>
        </tr>
    </table>
    <br>
    <table width="600">
        <tr>
            <td class="c" colspan="6">@lang('admin/overview.index.online')</td>
        </tr>
        <tr>
            <th><a href="?sort=id">@lang('admin/overview.index.id')</a></th>
            <th><a href="?sort=username">@lang('admin/overview.index.username')</a></th>
            <th><a href="?sort=user_lastip">@lang('admin/overview.index.ip')</a></th>
            <th><a href="?sort=ally_name">@lang('admin/overview.index.points')</a></th>
            <th>@lang('admin/overview.index.points')</th>
            <th><a href="?sort=onlinetime">@lang('admin/overview.index.last_activity')</a></th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <th><a href="../messages.php?mode=write&id={{ $user->id }}"><img src="{{ skin_asset('img/m.gif') }}" alt="@lang('admin/overview.index.pm_alt')" title="@lang('admin/overview.index.pm_title')" border="0"></a></th>
            <th><a href= # title="{{ $user->user_agent }}">{{ $user->username }}</a></th>
            <th><a style="color:{{ $user->ip_color }};" href="http://network-tools.com/default.asp?prog=trace&host={{ $user->user_lastip }}">[{{ $user->user_lastip }}]</a></th>
            <th>{{ $user->ally_name }}</th>
            <th>{{ pretty_number($user->points) }}</th>
            <th>{{ pretty_time(time() - $user->onlinetime) }}</th>
        </tr>
        @endforeach
        <tr>
            <th class="b" colspan="6">@lang('admin/overview.index.online_count'): {{ $users->count() }}</th>
        </tr>
    </table>
@endsection