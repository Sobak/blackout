@extends('base')
@section('content')
<br><br>
<center>
    <table width="519">
        <tr>
            <td class="c">{{ $title }}</td>
        </tr><tr>
            <th class="errormessage">{!! $message !!}</th>
        </tr>
    </table>
</center>
@endsection

@push('head_extras')
    @if ($redirectTo)
        <meta http-equiv="refresh" content="{{ $redirectTime }};URL={{ $redirectTo }}">
    @endif
@endpush
