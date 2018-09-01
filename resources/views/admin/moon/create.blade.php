@extends('base')
@section('content')
    <br><br>
    <h2>@lang('admin/moon.create.title')</h2>
    <form action="{{ route('admin.moon.add') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="mode" value="addit">
        <table width="320" border="0" cellspacing="2" cellpadding="0" style="color:#FFFFFF">
            <tr>
                <td class="c" colspan="6">@lang('admin/moon.create.table_title')</td>
            </tr><tr>
                <th width="150">@lang('admin/moon.create.mother')</th>
                <th width="0%"><input type="text" name="user" size="3"></th>
            </tr><tr>
                <th>@lang('admin/moon.create.name')</th>
                <th><input type="text" name="name"></th>
            </tr><tr>
                <th colspan="2"><input type="submit" value="@lang('admin/moon.create.submit')"></th>
        </table>
    </form>
@endsection