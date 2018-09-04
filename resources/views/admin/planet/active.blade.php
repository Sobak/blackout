@extends('base')
@section('content')
    <br><br>
    <h2>@lang('admin/planet.active.title')</h2>
    <table width="519">
        <tr><td class="c" colspan="4">@lang('admin/planet.active.title')</td></tr>
        <tr>
            <th>@lang('admin/planet.active.name')</th>
            <th>@lang('admin/planet.active.position')</th>
            <th>@lang('admin/planet.active.points')</th>
            <th>@lang('admin/planet.active.active')</th>
        </tr>
        @foreach ($planets as $planet)
        <tr>
            <td class="b"><center><b>{{ $planet->name }}</b></center></td>
            <td class="b"><center><b>[{{ $planet->galaxy }}:{{ $planet->system }}:{{ $planet->planet }}]</b></center></td>
            <td class="b"><center><b>{{ pretty_number($planet->points / 1000) }}</b></center></td>
            <td class="b"><center><b>{{ pretty_time(time() - $planet->last_update) }}</b></center></td>
        </tr>
        @endforeach
        <tr>
            <th class="b" colspan="4">@lang('admin/planet.active.total'): {{ $planets->count() }}</th>
        </tr>
    </table>
@endsection