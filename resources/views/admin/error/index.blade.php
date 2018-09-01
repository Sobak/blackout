@extends('base')
@section('content')
<br><br>
<h2>@lang('admin/errors.title')</h2>
<table width="519">
    <tr>
        <td class="c" colspan="4">@lang('admin/errors.list-title') [<a href="{{ route('admin.errors.clear') }}">@lang('admin/errors.clear')</a>]</td>
    </tr>
    <tr>
        <th>@lang('admin/errors.type')</th>
        <th>@lang('admin/errors.player')</th>
        <th>@lang('admin/errors.date')</th>
    </tr>
    @foreach ($errors as $error)
        <tr>
            <th>{{ $error->error_type }} [<a href={{ route('admin.errors.remove', [$error->error_id]) }}>X</a>]</th>
            <th>{{ $error->error_sender }}</th>
            <th>{{ $error->error_time->format(trans('app.format-datetime')) }}</th>
        </tr>
        <tr>
            <td class="b" colspan="3" width="500">{{ nl2br($error->error_text) }}</td>
        </tr>
    @endforeach
    <tr>
        <th class="b" colspan="5">{{ $errors->count() }} @lang('admin/errors.count')</th>
    </tr>
</table>
@endsection