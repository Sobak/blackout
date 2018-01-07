<script>
function f(target_url) {
  var new_win = window.open(target_url, '', 'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
  new_win.focus();
}
</script>
<div id="left_menu" class="style">
<table>
    <tr>
        <td style="border-top: 1px #545454 solid; font-weight: bold"><center>{servername}<br>(<font color=red>{XNovaRelease}</font>)</td>
    </tr>
    <tr><th>{devlp}</th></tr>
    <tr><td><a href="overview.php" accesskey="g">{Overview}</a></td></tr>
    <tr><td><a href="buildings.php" accesskey="b">{Buildings}</a></td></tr>
    <tr><td><a href="buildings.php?mode=research" accesskey="r">{Research}</a></td></tr>
    <tr><td><a href="buildings.php?mode=fleet" accesskey="f">{Shipyard}</a></td></tr>
    <tr><td><a href="buildings.php?mode=defense" accesskey="d">{Defense}</a></td></tr>
    <tr><td><a href="officier.php" accesskey="o">{Officiers}</a></td></tr>
    <tr><td><a href="marchand.php" accesskey="m">{Marchand}</a></td></tr>

    <tr><th>{navig}</th></tr>
    <tr><td><a href="alliance.php" accesskey="a">{Alliance}</a></td></tr>
    <tr><td><a href="fleet.php" accesskey="t">{Fleet}</a></td></tr>
    <tr><td><a href="messages.php" accesskey="c">{Messages}</a></td></tr>

    <tr><th>{observ}</th></tr>
    <tr><td><a href="galaxy.php?mode=0" accesskey="s">{Galaxy}</a></td></tr>
    <tr><td><a href="imperium.php" accesskey="i">{Imperium}</a></td></tr>
    <tr><td><a href="resources.php" accesskey="r">{Resources}</a></td></tr>
    <tr><td><a href="techtree.php" accesskey="g">{Technology}</a></td></tr>

    <tr><th>{community}</th></tr>
    <tr><td><a href="records.php" accesskey="3">{Records}</a></td></tr>
    <tr><td><a href="stat.php?start={user_rank}" accesskey="k">{Statistics}</a></td></tr>
    <tr><td><a href="search.php" accesskey="b">{Search}</a></td></tr>
    <tr><td><a href="banned.php" accesskey="3">{blocked}</a></td></tr>
    <tr><td><a href="annonce.php" accesskey="3">{Annonces}</a></td></tr>

    <tr><th>{commun}</th></tr>
    <tr><td><a href="#" onClick="f('buddy.php', '');" accesskey="c">{Buddylist}</a></td></tr>
    <tr><td><a href="#" onClick="f('notes.php', 'Report');" accesskey="n">{Notes}</a></td></tr>
    <tr><td><a href="chat.php" accesskey="a">{Chat}</a></td></tr>
    <tr><td><a href="{forum_url}" accesskey="1">{Board}</a></td></tr>
    <tr><td><a href="contact.php" accesskey="3" >{Contact}</a></td></tr>
    <tr><td><a href="options.php" accesskey="o">{Options}</a></td></tr>
    {ADMIN_LINK}

    <tr><td><a href="logout.php" accesskey="s" style="color:red">{Logout}</a></td></tr>
    <tr><th>{infog}</th></tr>
    <tr><td>{server_info}</td></tr>
    <tr>
        <td><center><a href="credit.php" accesskey="T">XNova Team</a>&copy; Copyright 2008</center></td>
    </tr>
</table>
</div>