@extends('base')
@section('content')
    <br><br>
    <h2>@lang('admin/user.index.title')</h2>
    <table width="569" style="color:#FFFFFF">
        <tr>
            <td class="c" colspan="9">@lang('admin/user.index.table_title')</td>
        </tr>
        <tr>
            <th><a href="?sort=id">@lang('admin/user.index.id')</a></th>
            <th><a href="?sort=username">@lang('admin/user.index.username')</a></th>
            <th><a href="?sort=email">@lang('admin/user.index.email')</a></th>
            <th><a href="?sort=user_lastip">@lang('admin/user.index.ip')</a></th>
            <th><a href="?sort=register_time">@lang('admin/user.index.registered_at')</a></th>
            <th><a href="?sort=onlinetime">@lang('admin/user.index.last_login_at')</a></th>
            <th><a href="?sort=bana">@lang('admin/user.index.banned')</a></th>
            <th>@lang('admin/user.index.details')</th>
            <th>@lang('admin/user.index.action')</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ $user->username }}</th>
            <th>{{ $user->email }}</th>
            <th><font color="{{ $user->ip_color }}">{{ $user->user_lastip }}</font></th>
            <th>{{ gmdate('d/m/Y G:i:s', $user->register_time) }}</th>
            <th>{{ gmdate('d/m/Y G:i:s', $user->onlinetime) }}</th>
            <th>{!! $user->banned !!}</th>
            <th></th>
            <th><a href="{{ route('admin.user.remove', $user->id) }}"><img src="../images/r1.png"></a></th>
        </tr>
        @endforeach
        <tr>
            <th class="b" colspan="9">{{ $users->count() }} @lang('admin/user.index.count')</th>
        </tr>
    </table>
@endsection