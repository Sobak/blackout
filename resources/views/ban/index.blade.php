@extends('base')
@section('content')
    <br>
    <table width="600" style="color:#FFFFFF">
        <tr>
            <td class="c" colspan="6">@lang('ban.table_title')</td>
        </tr>
        <tr>
            <th>@lang('ban.username')</th>
            <th>@lang('ban.reason')</th>
            <th>@lang('ban.from')</th>
            <th>@lang('ban.to')</th>
            <th>@lang('ban.by')</th>
        </tr>
        @foreach ($banned as $ban)
        <tr style="text-align: center">
            <td class="b">{{ $ban->who }}</td>
            <td class="b">{{ $ban->theme }}</td>
            <td class="b">{{ gmdate('d/m/Y G:i:s', $ban->time) }}</td>
            <td class="b">{{ gmdate('d/m/Y G:i:s', $ban->longer) }}</td>
            <td class="b">{{ $ban->author }}</td>
        </tr>
        @endforeach
        <tr>
            <th class="b" colspan="6">{{ $count }}</th>
        </tr>
    </table>
@endsection
