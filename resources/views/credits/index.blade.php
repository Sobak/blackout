@extends('base')
@section('content')
    <br><br>
    <table width="475">
        <tbody>
        <tr>
            <td colspan="2" class="c"><div align="center"><img src="images/xnova.png" width="213" height="93" /></div></td>
        </tr>
        <tr>
            <td colspan="2" class="c"><b>@lang('credits.links')</b></td>
        </tr>
        <tr>
            <th width="278">@lang('credits.repository')</th>
            <th width="279"><a href="https://github.com/Sobak/blackout">github.com/Sobak/blackout</a></th>
        </tr>
        <tr>
            <td colspan="2" class="c"><b>@lang('credits.blackout')</b></td>
        </tr>
        <tr>
            <th width="278">Sobak</th>
            <th width="279">@lang('credits.creator') / @lang('credits.programmer') / @lang('credits.designer')</th>
        </tr>
        <tr>
            <td colspan="2" class="c"><b>@lang('credits.xnova')</b></td>
        </tr>
        <tr>
            <th width="278">
                Raito<br>
                Chlorel<br>
                e-Zobar<br>
                Flousedid<br>
            </th>
            <th width="279">
                @lang('credits.creator') / @lang('credits.programmer')<br>
                @lang('credits.lead') @lang('credits.programmer')<br>
                @lang('credits.designer') / @lang('credits.programmer')<br>
                @lang('credits.webmaster')<br>
            </th>
        </tr>
        <tr>
            <td colspan="2" class="c"><b>@lang('credits.ugamela')</b></td>
        </tr>
        <tr>
            <th width="278">UGamela Britania </th>
            <th width="279">@lang('credits.base')</th>
        </tr>
    </table>
@endsection
