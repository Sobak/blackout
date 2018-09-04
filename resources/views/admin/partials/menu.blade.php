<div id="left_menu" class="style">
<table>
    <tr>
        <td style="border-top: 1px #545454 solid; font-weight: bold"><center>{{ $servername }}<br>(<font color=red>{{ $version }}</font>)</td>
    </tr>
    <tr><th>@lang('admin/menu.sections.admin')</th></tr>
    <tr><td><a href="{{ route('admin.index') }}" accesskey="v">@lang('admin/menu.overview')</a></td></tr>
    <tr><td><a href="settings.php" accesskey="e">@lang('admin/menu.config')</a></td></tr>
    <tr><td><a href="XNovaResetUnivers.php" accesskey="e">@lang('admin/menu.reset')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.players')</th></tr>
    <tr><td><a href="{{ route('admin.users') }}" accesskey="a">@lang('admin/menu.players')</a></td></tr>
    <tr><td><a href="paneladmina.php" accesskey="k">@lang('admin/menu.players-search')</a></td></tr>
    <tr><td><a href="{{ route('admin.resource.add') }}" accesskey="k">@lang('admin/menu.resources-add')</a></td></tr>
    <tr><td><a href="{{ route('admin.resource.subtract') }}" accesskey="k">@lang('admin/menu.resources-sub')</a></td></tr>
    <tr><td class="separated"><a href="{{ route('admin.planets') }}" accesskey="1">@lang('admin/menu.planets')</a></td></tr>
    <tr><td><a href="{{ route('admin.planets.active') }}" accesskey="k">@lang('admin/menu.planets-active')</a></td></tr>
    <tr><td><a href="{{ route('admin.moons') }}" accesskey="k">@lang('admin/menu.moons')</a></td></tr>
    <tr><td><a href="{{ route('admin.moon.add') }}" accesskey="k">@lang('admin/menu.moon-add')</a></td></tr>
    <tr><td><a href="ShowFlyingFleets.php" accesskey="k">@lang('admin/menu.fleets')</a></td></tr>
    <tr><td class="separated"><a href="{{ route('admin.ban') }}" accesskey="k">@lang('admin/menu.ban')</a></td></tr>
    <tr><td><a href="{{ route('admin.unban') }}" accesskey="k">@lang('admin/menu.unban')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.tools')</th></tr>
    <tr><td><a href="{{ route('admin.chat') }}" accesskey="p">@lang('admin/menu.chat')</a></td></tr>
    <tr><td><a href="statbuilder.php" accesskey="p">@lang('admin/menu.stats')</a></td></tr>
    <tr><td><a href="fix_queues.php" accesskey="p">@lang('admin/menu.queues')</a></td></tr>
    <tr><td><a href="messagelist.php" accesskey="k">@lang('admin/menu.messages')</a></td></tr>
    <tr><td class="separated"><a href="{{ route('admin.errors') }}" accesskey="e">@lang('admin/menu.errors')</a></td></tr>
    <tr><td><a href="../overview.php" accesskey="i" style="color:red">@lang('admin/menu.back')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.info')</th></tr>
    <tr>
        <td><center><a href="{{ route('credits') }}" accesskey="T">Blackout &amp; XNova Teams</a>&copy; Copyright 2018</center></td>
    </tr>
</table>
</div>
