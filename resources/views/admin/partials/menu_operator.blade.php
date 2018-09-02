<div id="left_menu" class="style">
<table>
    <tr>
        <td style="border-top: 1px #545454 solid; font-weight: bold"><center>{{ $servername }}<br>(<font color=red>{{ $version }}</font>)</td>
    </tr>
    <tr><th>@lang('admin/menu.sections.admin')</th></tr>
    <tr><td><a href="{{ route('admin.index') }}" accesskey="v">@lang('admin/menu.overview')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.players')</th></tr>
    <tr><td><a href="paneladmina.php" accesskey="k">@lang('admin/menu.players-search')</a></td></tr>
    <tr><td><a href="activeplanet.php" accesskey="k">@lang('admin/menu.planets-active')</a></td></tr>
    <tr><td><a href="ShowFlyingFleets.php" accesskey="k">@lang('admin/menu.fleets')</a></td></tr>
    <tr><td class="separated"><a href="{{ route('admin.ban') }}" accesskey="k">@lang('admin/menu.ban')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.tools')</th></tr>
    <tr><td><a href="statbuilder.php" accesskey="p">@lang('admin/menu.stats')</a></td></tr>
    <tr><td class="separated"><a href="fix_queues.php" accesskey="p">@lang('admin/menu.queues')</a></td></tr>
    <tr><td><a href="../overview.php" accesskey="i" style="color:red">@lang('admin/menu.back')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.info')</th></tr>
    <tr>
        <td><center><a href="{{ route('credits') }}" accesskey="T">Blackout &amp; XNova Teams</a>&copy; Copyright 2018</center></td>
    </tr>
</table>
</div>
