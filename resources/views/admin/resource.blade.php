@extends('base')
@section('content')
<br><br>
<h2>{{ trans("admin/resources.$action.title") }}</h2>
<form action="{{ route("admin.resource.$action") }}" method="post">
    {{ csrf_field() }}
    <table width="305">
        <tbody>
        <tr>
            <td class="c" colspan="6">{{ trans("admin/resources.$action.form") }}</td>
        </tr><tr>
            <th width="130">{{ trans('admin/resources.planet_id') }}</th>
            <th width="155"><input name="planet_id" type="text" value="0" size="3" /></th>
        </tr><tr>
            <th>{{ trans('resources.metal') }}</th>
            <th><input name="metal" type="text" value="0" /></th>
        </tr><tr>
            <th>{{ trans('resources.crystal') }}</td>
            <th><input name="crystal" type="text" value="0" /></th>
        </tr><tr>
            <th>{{ trans('resources.deuterium') }}</td>
            <th><input name="deuterium" type="text" value="0" /></th>
        </tr><tr>
            <th colspan="2"><input type="Submit" value="{{ trans("admin/resources.$action.submit") }}" /></th>
        </tbody>
        </tr>
    </table>
</form>
@endsection