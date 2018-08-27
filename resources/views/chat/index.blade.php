@extends('base')
@section('content')
    <script language="JavaScript" type="text/javascript" src="scripts/chat.js"></script>

    <br><br>

    <table align="center"><tbody>

        <tr><td class="c"><b>@lang('chat.table_title')</b></td></tr>

        <tr><th><div id="shoutbox" style="margin: 5px; vertical-align: text-top; height: 305px; overflow:hidden;"></div></th></tr>

        <tr><th>@lang('chat.message'): <input name="msg" type="text" id="msg" size="80" maxlength="100" onKeyPress="if(event.keyCode == 13){ addMessage(); } if (event.keyCode==60 || event.keyCode==62) event.returnValue = false; if (event.which==60 || event.which==62) return false;"> <input type="button" name="send" value="@lang('chat.send')" id="send" onClick="addMessage()"></th></tr>

        </tbody></table>

    <br>
    <table width="355" align="center"><tbody>

        <tr><td colspan="2" class="c"><b>@lang('chat.bbcode')</b></td></tr>

        <tr><th colspan="2"><img src="images/smileys/cry.png" align="absmiddle" title=":c" alt=":c" width="12" height="12" onClick="addSmiley(':c')">
                <img src="images/smileys/confused.png" align="absmiddle" title=":/" alt=":/" width="12" height="12" onClick="addSmiley(':/')">
                <img src="images/smileys/dizzy.png" align="absmiddle" title="o0" alt="o0" width="12" height="12" onClick="addSmiley('o0')">
                <img src="images/smileys/happy.png" align="absmiddle" title="^^" alt="^^" width="12" height="12" onClick="addSmiley('^^')">
                <img src="images/smileys/lol.png" align="absmiddle" title=":D" alt=":D" width="12" height="12" onClick="addSmiley(':D')">
                <img src="images/smileys/neutral.png" align="absmiddle" title=":|" alt=":|" width="12" height="12" onClick="addSmiley(':|')">
                <img src="images/smileys/smile.png" align="absmiddle" title=":)" alt=":)" width="12" height="12" onClick="addSmiley(':)')">
                <img src="images/smileys/omg.png" align="absmiddle" title=":o" alt=":o" width="12" height="12" onClick="addSmiley(':o')">
                <img src="images/smileys/tongue.png" align="absmiddle" title=":p" alt=":p" width="12" height="12" onClick="addSmiley(':p')">
                <img src="images/smileys/sad.png" align="absmiddle" title=":(" alt=":(" width="12" height="12" onClick="addSmiley(':(')">
                <img src="images/smileys/wink.png" align="absmiddle" title=";)" alt=";)" width="12" height="12" onClick="addSmiley(';)')">
                <img src="images/smileys/shit.png" align="absmiddle" title=":s" alt=":s" width="12" height="12" onClick="addSmiley(':s')"></th></tr>

        <tr><th width="60"><b>@lang('chat.text')</b><br><i>@lang('chat.text')</i><br><u>@lang('chat.text')</u><br><a href="http://example.com" target="_blank">@lang('chat.text')</a><br><font color="red">@lang('chat.text')</font></th>

            <th>[b]@lang('chat.text')[/b]<br>[i]@lang('chat.text')[/i]<br>[u]@lang('chat.text')[/u]<br>[url=http://example.com]@lang('chat.text')[/url]<br>[c=blue|yellow|green|pink|red|orange]@lang('chat.text')[/c]</th></tr>

        </tbody></table>
@endsection
