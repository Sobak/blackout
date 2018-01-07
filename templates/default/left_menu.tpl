<script language="JavaScript">
function f(target_url,win_name) {
  var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
  new_win.focus();
}
</script>
<div id="left_menu" class="style">
<br>
<table width="130" cellspacing="0" cellpadding="0">
<tr>
    <td colspan="2" style="border-top: 1px #545454 solid; font-weight: bold"><center>{servername}<br>(<font color=red>{XNovaRelease}</font>)</td>
</tr><tr>
    <td colspan="2" background="{dpath}img/bg1.gif"><center>{devlp}</center></td>
</tr><tr>
    <td colspan="2"><div><a href="overview.php" accesskey="g">{Overview}</a></div></td>
</tr><tr>

    <td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
    <td colspan="2"><div><a href="buildings.php" accesskey="b">{Buildings}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="buildings.php?mode=research" accesskey="r">{Research}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="buildings.php?mode=fleet" accesskey="f">{Shipyard}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="buildings.php?mode=defense" accesskey="d">{Defense}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="officier.php" accesskey="o">{Officiers}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="marchand.php" accesskey="m">{Marchand}</a></div></td>
</tr><tr>

    <td colspan="2" background="{dpath}img/bg1.gif"><center>{navig}</center></td>
</tr><tr>
    <td colspan="2"><div><a href="alliance.php" accesskey="a">{Alliance}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="fleet.php" accesskey="t">{Fleet}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="messages.php" accesskey="c">{Messages}</a></div></td>
</tr><tr>

    <td colspan="2" background="{dpath}img/bg1.gif"><center>{observ}</center></td>
</tr><tr>
    <td colspan="2"><div><a href="galaxy.php?mode=0" accesskey="s">{Galaxy}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="imperium.php" accesskey="i">{Imperium}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="resources.php" accesskey="r">{Resources}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="techtree.php" accesskey="g">{Technology}</a></div></td>
</tr><tr>

    <td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
    <td colspan="2"><div><a href="records.php" accesskey="3">{Records}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="stat.php?start={user_rank}" accesskey="k">{Statistics}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="search.php" accesskey="b">{Search}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="banned.php" accesskey="3">{blocked}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="annonce.php" accesskey="3">{Annonces}</a></div></td>
</tr><tr>

    <td colspan="2" background="{dpath}img/bg1.gif"><center>{commun}</center></td>
</tr><tr>
    <td colspan="2"><div><a href="#" onClick="f('buddy.php', '');" accesskey="c">{Buddylist}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="#" onClick="f('notes.php', 'Report');" accesskey="n">{Notes}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="chat.php" accesskey="a">{Chat}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="{forum_url}" accesskey="1">{Board}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="contact.php" accesskey="3" >{Contact}</a></div></td>
</tr><tr>
    <td colspan="2"><div><a href="options.php" accesskey="o">{Options}</a></div></td>
</tr>
    {ADMIN_LINK}

<tr>
    <td colspan="2"><div><a href="logout.php" accesskey="s" style="color:red">{Logout}</a></div></td>
</tr><tr>
    <td colspan="2" background="{dpath}img/bg1.gif"><center>{infog}</center></td>
</tr>
    {server_info}
<tr>
    <td colspan="2"><div><center><a href="credit.php" accesskey="T">XNova Team</a><br>&copy; Copyright 2008</center></div></td>
</tr>
</table>
</div>