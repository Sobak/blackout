@extends('base')
@section('content')
    <center>
        <br><br>
        <table width="569">
            <tbody>
            <tr>
                <td colspan="3" class="c"><b>@lang('contact.table_title')</b></td>
            </tr><tr>
                <th colspan="3">
                    <font color="orange">@lang('contact.table_description')</font>
                </th>
            </tr><tr>
                <th><font color="lime">@lang('contact.username')</font></th>
                <th><font color="lime">@lang('contact.rank')</font></th>
                <th><font color="lime">@lang('contact.email')</font></th>
            </tr>
            @foreach ($admins as $admin)
            <tr>
                <th>{{ $admin->username }}</th>
                <th>{{ trans('user.levels.' . $admin->authlevel) }}</th>
                <th><a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a></th>
            </tr>
            @endforeach
            <tr>
            </tr>
            </tbody>
        </table>
    </center>
@endsection
