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
    <td style="border-top: 1px #545454 solid; font-weight: bold"><center>{servername}<br>(<font color=red>{XNovaRelease}</font>)</td>
</tr><tr>
    <td background="{dpath}img/bg1.gif"><center>{admin}</center></td>
</tr><tr>
    <td><div><a href="overview.php" accesskey="v">{adm_over}</a></div></td>
</tr><tr>
    <td background="{dpath}img/bg1.gif"><center>{player}</center></td>
</tr><tr>
    <td><div><a href="paneladmina.php" accesskey="k">{adm_plrsch}</a></div></td>
</tr><tr>
    <td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
    <td><div><a href="activeplanet.php" accesskey="k">{adm_actplt}</a></div></td>
</tr><tr>
    <td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
    <td><div><a href="ShowFlyingFleets.php" accesskey="k">{adm_fleet}</a></div></td>
</tr><tr>
    <td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
    <td><div><a href="banned.php" accesskey="k">{adm_ban}</a></div></td>
</tr><tr>
    <td background="{dpath}img/bg1.gif"><center>{tool}</center></td>
</tr><tr>
    <td><div><a href="statbuilder.php" accesskey="p">{adm_updpt}</a></div></td>
</tr><tr>
    <td><div><a href="ElementQueueFixer.php" accesskey="p">{adm_build}</a></div></td>
</tr><tr>
    <td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
    <td><div><a href="http://www.xnova.fr/forum/index.php" accesskey="3">{adm_help}</a></div></td>
</tr><tr>
    <td><div><a href="../overview.php" accesskey="i" target="_top" style="color:red">{adm_back}</a></div></td>
</tr><tr>
    <td background="{dpath}img/bg1.gif"><center>{infog}</center></td>
</tr><tr>
    <td><div><center><a href="../credit.php" accesskey="T">XNova Team</a><br>&copy; Copyright 2008</center></div></td>
</tr>
</table>
</div>