@extends('base')
@section('content')
    <br><br>
    <h2>@lang('admin/moon.index.title')</h2>
    <table width="500" style="color:#FFFFFF">
        <tr>
            <td class="c" colspan="6">@lang('admin/moon.index.title')</td>
        </tr>
        <tr>
            <th>@lang('admin/moon.index.id')</th>
            <th>@lang('admin/moon.index.name')</th>
            <th>@lang('admin/moon.index.mother')</th>
            <th>@lang('admin/moon.index.galaxy')</th>
            <th>@lang('admin/moon.index.system')</th>
            <th>@lang('admin/moon.index.planet')</th>
        </tr>
        @foreach ($moons as $moon)
        <tr>
            <td class="b"><center><b>{{ $moon->id }}</b></center></td>
            <td class="b"><center><b>{{ $moon->name }}</b></center></td>
            <td class="b"><center><b>{{ $moon->id_owner }}</b></center></td>
            <td class="b"><center><b>{{ $moon->galaxy }}</b></center></td>
            <td class="b"><center><b>{{ $moon->system }}</b></center></td>
            <td class="b"><center><b>{{ $moon->planet }}</b></center></td>
        </tr>
        @endforeach
        <tr>
            <th class="b" colspan="6">@lang('admin/moon.index.total'): {{ $moons->count() }}</th>
        </tr>
    </table>
@endsection