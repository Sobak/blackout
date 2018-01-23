<div id="left_menu" class="style">
<table>
    <tr>
        <td style="border-top: 1px #545454 solid; font-weight: bold"><center>{{ $servername }}<br>(<font color=red>{{ $version }}</font>)</td>
    </tr>
    <tr><th>@lang('admin/menu.sections.admin')</th></tr>
    <tr><td><a href="overview.php" accesskey="v">@lang('admin/menu.overview')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.players')</th></tr>
    <tr><td><a href="paneladmina.php" accesskey="k">@lang('admin/menu.players-search')</a></td></tr>
    <tr><td><a href="activeplanet.php" accesskey="k">@lang('admin/menu.planets-active')</a></td></tr>
    <tr><td><a href="ShowFlyingFleets.php" accesskey="k">@lang('admin/menu.fleets')</a></td></tr>
    <tr><td class="separated"><a href="banned.php" accesskey="k">@lang('admin/menu.ban')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.tools')</th></tr>
    <tr><td><a href="statbuilder.php" accesskey="p">@lang('admin/menu.stats')</a></td></tr>
    <tr><td><a href="fix_queues.php" accesskey="p">@lang('admin/menu.queues')</a></td></tr>
    <tr><td class="separated"><a href="http://www.xnova.fr/forum/index.php" accesskey="3">@lang('admin/menu.forum')</a></td></tr>
    <tr><td><a href="../overview.php" accesskey="i" style="color:red">@lang('admin/menu.back')</a></td></tr>

    <tr><th>@lang('admin/menu.sections.info')</th></tr>
    <tr>
        <td><center><a href="../credit.php" accesskey="T">XNova Team</a>&copy; Copyright 2008</center></td>
    </tr>
</table>
</div>
