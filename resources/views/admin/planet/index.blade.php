@extends('base')
@section('content')
    <br><br>
    <h2>@lang('admin/planet.index.title')</h2>
    <table width="500" style="color:#FFFFFF">
        <tr>
            <td class="c" colspan="6">@lang('admin/planet.index.title')</td>
        </tr>
        <tr>
            <th>@lang('admin/planet.index.id')</th>
            <th>@lang('admin/planet.index.name')</th>
            <th>@lang('admin/planet.index.galaxy')</th>
            <th>@lang('admin/planet.index.system')</th>
            <th>@lang('admin/planet.index.planet')</th>
        </tr>
        @foreach ($planets as $planet)
        <tr>
            <td class="b"><center><b>{{ $planet->id }}</b></center></td>
            <td class="b"><center><b>{{ $planet->name }}</b></center></td>
            <td class="b"><center><b>{{ $planet->galaxy }}</b></center></td>
            <td class="b"><center><b>{{ $planet->system }}</b></center></td>
            <td class="b"><center><b>{{ $planet->planet }}</b></center></td>
        </tr>
        @endforeach
        <tr>
            <th class="b" colspan="6">@lang('admin/planet.index.total'): {{ $planets->count() }}</th>
        </tr>
    </table>
@endsection