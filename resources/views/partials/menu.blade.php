<script>
    function f(target_url) {
        var new_win = window.open(target_url, '', 'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
        new_win.focus();
    }
</script>
<div id="left_menu" class="style">
    <table>
        <tr>
            <td style="border-top: 1px #545454 solid; font-weight: bold"><center>{{ $servername }}<br>(<font color=red>{{ $version }}</font>)</td>
        </tr>
        <tr><th>@lang('menu.sections.development')</th></tr>
        <tr><td><a href="overview.php" accesskey="g">@lang('menu.overview')</a></td></tr>
        <tr><td><a href="buildings.php" accesskey="b">@lang('menu.buildings')</a></td></tr>
        <tr><td><a href="buildings.php?mode=research" accesskey="r">@lang('menu.research')</a></td></tr>
        <tr><td><a href="buildings.php?mode=fleet" accesskey="f">@lang('menu.shipyard')</a></td></tr>
        <tr><td><a href="buildings.php?mode=defense" accesskey="d">@lang('menu.defense')</a></td></tr>
        <tr><td><a href="officier.php" accesskey="o">@lang('menu.officers')</a></td></tr>
        <tr><td><a href="marchand.php" accesskey="m">@lang('menu.merchant')</a></td></tr>

        <tr><th>@lang('menu.sections.navigation')</th></tr>
        <tr><td><a href="alliance.php" accesskey="a">@lang('menu.alliance')</a></td></tr>
        <tr><td><a href="fleet.php" accesskey="t">@lang('menu.fleet')</a></td></tr>
        <tr><td><a href="messages.php" accesskey="c">@lang('menu.messages')</a></td></tr>

        <tr><th>@lang('menu.sections.observatory')</th></tr>
        <tr><td><a href="galaxy.php?mode=0" accesskey="s">@lang('menu.galaxy')</a></td></tr>
        <tr><td><a href="imperium.php" accesskey="i">@lang('menu.imperium')</a></td></tr>
        <tr><td><a href="resources.php" accesskey="r">@lang('menu.resources')</a></td></tr>
        <tr><td><a href="techtree.php" accesskey="g">@lang('menu.technology')</a></td></tr>

        <tr><th>@lang('menu.sections.community')</th></tr>
        <tr><td><a href="records.php" accesskey="3">@lang('menu.records')</a></td></tr>
        <tr><td><a href="stat.php" accesskey="k">@lang('menu.statistics')</a></td></tr>
        <tr><td><a href="search.php" accesskey="b">@lang('menu.search')</a></td></tr>
        <tr><td><a href="banned.php" accesskey="3">@lang('menu.banned')</a></td></tr>
        <tr><td><a href="annonce.php" accesskey="3">@lang('menu.announcements')</a></td></tr>

        <tr><th>@lang('menu.sections.communication')</th></tr>
        <tr><td><a href="#" onClick="f('buddy.php', '');" accesskey="c">@lang('menu.friends')</a></td></tr>
        <tr><td><a href="#" onClick="f('notes.php', 'Report');" accesskey="n">@lang('menu.notes')</a></td></tr>
        <tr><td><a href="chat.php" accesskey="a">@lang('menu.chat')</a></td></tr>
        <tr><td><a href="{!! $forum_url !!}" accesskey="1">@lang('menu.forum')</a></td></tr>
        <tr><td><a href="contact.php" accesskey="3" >@lang('menu.contact')</a></td></tr>
        <tr><td><a href="options.php" accesskey="o">@lang('menu.options')</a></td></tr>
        @if ($user->authlevel > \App\Models\User::LEVEL_PLAYER)
            <tr><td><a href="admin/overview.php" style="color:lime">{{ trans('menu.admin.' . $user->authlevel) }}</a></td></tr>
        @endif

        <tr><td><a href="{{ route('user.logout') }}" accesskey="s" style="color:red">@lang('menu.logout')</a></td></tr>
        <tr><th>@lang('menu.sections.info')</th></tr>
        <tr>
            <td>
                <table class="server-info">
                    <tr>
                        <td>@lang('menu.info.game')</td>
                        <td align="right">x {{ $info['game'] }}</td>
                    </tr>
                    <tr>
                        <td>@lang('menu.info.fleet')</td>
                        <td align="right">x {{ $info['fleet'] }}</td>
                    </tr>
                    <tr>
                        <td>@lang('menu.info.resources')</td>
                        <td align="right">x {{ $info['resources'] }}</td>
                    </tr>
                    <tr>
                        <td>@lang('menu.info.queue')</td>
                        <td align="right">{{ $info['queue'] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><center><a href="credit.php" accesskey="T">Blackout &amp; XNova Teams</a>&copy; Copyright 2018</center></td>
        </tr>
    </table>
</div>