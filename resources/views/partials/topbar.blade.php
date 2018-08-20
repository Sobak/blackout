<div id="header_top">
    <center>
        <table class="header">
            <tbody>
            <tr class="header">
                <td class="header">
                    <center>
                        <table class="header">
                            <tbody>
                            <tr class="header">
                                <td class="header"><img src="{{ skin_asset("planeten/small/s_{$planet->image}.jpg") }}" height="50" width="50"></td>
                                <td  class="header" valign="middle">
                                    <select size="1" onChange="eval('location=\''+this.options[this.selectedIndex].value+'\'');">
                                        {!! $planetList !!}
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </center>
                </td>
                <td class="header">
                    <table style="width: 508px;" class="header" id="resources" padding-right="30" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr class="header">
                            <td class="header" align="center" width="140"><img src="{{ skin_asset('images/metall.gif') }}" border="0" height="22" width="42"></td>
                            <td class="header" align="center" width="140"><img src="{{ skin_asset('images/kristall.gif') }}" border="0" height="22" width="42"></td>
                            <td class="header" align="center" width="140"><img src="{{ skin_asset('images/deuterium.gif') }}" border="0" height="22" width="42"></td>
                            <td class="header" align="center" width="140"><img src="{{ skin_asset('images/energie.gif') }}" border="0" height="22" width="42"></td>
                            <td class="header" align="center" width="140"><img src="{{ skin_asset('images/message.gif') }}" border="0" height="22" width="42"></td>
                        </tr>
                        <tr class="header">
                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">@lang('resources.metal')</font></b></i></td>
                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">@lang('resources.crystal')</font></b></i></td>
                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">@lang('resources.deuterium')</font></b></i></td>
                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">@lang('resources.energy')</font></b></i></td>
                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">@lang('messages.topbar_name')</font></b></i></td>
                        </tr>
                        <tr class="header">
                            <td class="header" align="center" width="140"><font>{!! $metal !!}</font></td>
                            <td class="header" align="center" width="140"><font>{!! $crystal !!}</font></td>
                            <td class="header" align="center" width="140"><font>{!! $deuterium !!}</font></td>
                            <td class="header" align="center" width="140"><font>{!! $energy !!}</font></td>
                            <td class="header" align="center" width="140"><font>0</font></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </center>
</div>
