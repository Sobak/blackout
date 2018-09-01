@extends('base')
@section('content')
<br><br>
<h2>@lang('admin/chat.title')</h2>
<table width="400">
    <tr>
        <td class="c" colspan="4">@lang('admin/chat.list-title') [<a href="{{ route('admin.chat.clear') }}">@lang('admin/chat.clear')</a>]</td>
    </tr>
    <tr>
        <th width="5%">@lang('admin/chat.id')</th>
        <th width="30%">@lang('admin/chat.remove')</th>
        <th width="30%">@lang('admin/chat.player')</th>
        <th width="34%">@lang('admin/chat.date')</th>
    </tr>
    @foreach ($messages as $message)
        <tr>
            <td class="n" rowspan="2">{{ $message->id }}</td>
            <td class="n"><center>[<a href={{ route('admin.chat.remove', [$message->id]) }}>X</a>]</center></td>
            <td class="n"><center>{{ $message->user->username }}</center></td>
            <td class="n"><center>{{ $message->timestamp->format(trans('app.format-datetime')) }}</center></td>
        </tr>
        <tr>
            <td class="b" colspan="4" width="500">{{ nl2br($message->message) }}</td>
        </tr>
    @endforeach
    <tr>
        <th class="b" colspan="5">{{ $messages->count() }} @lang('admin/chat.count')</th>
    </tr>
</table>
@endsection