<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <link href="skins/xnova/formate.css" rel="stylesheet" type="text/css">
  <title>XNova</title>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/about.css">
</head>
<body>
  <div id="main">
     <script type="text/javascript">
	var lastType = "";
	function changeAction(type) {
	if (document.formular.Uni.value == '') {
	    alert('{log_univ}'); }
	else {
	    if(type == "login" && lastType == "") {
	    var url = "http://" + document.formular.Uni.value + "";
	    document.formular.action = url; }
	else {
            var url = "http://" + document.formular.Uni.value + "/reg.php";
            document.formular.action = url;
            document.formular.submit(); } } }
     </script>
  <div id="login"><a name="pustekuchen"></a>
  <div id="login_input">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr style="vertical-align: top;">
<td style="padding-right: 4px;">
<form name="formular" action="" method="post" onsubmit="changeAction('login');" style="margin-top: -9px; margin-left: 70px;"> <input name="timestamp" value="1173621187" type="hidden"><input name="v" value="2" type="hidden">{User_name} <input name="username" value="" type="text">
{Password} <input name="password" value="" type="password"><br>
{Remember_me} <input name="rememberme" type="checkbox"> <script type="text/javascript">document.formular.Uni.focus(); </script><input name="submit" value="{Login}" type="submit"><label></label></form>
<a href="lostpassword.php">{PasswordLost}</a>
</td>
</tr>
</tbody>
</table>
</div>
<div id="downmenu">&nbsp;</div>
</div>
<div id="mainmenu" style="margin-top: 20px;">
<a href="reg.php">{log_reg}</a>
<a href="{forum_url}">Forum</a>
<a href="contact.php">Contact</a>
<a href="credit.php">{log_cred}</a>
</div>
<div id="rightmenu" class="rightmenu">
<div id="title"></div>
<div id="content">
<div style="text-align: left;"></div>
<center>
<div style="text-align: left;"></div>
<div id="text1">
<div style="text-align: left;"><strong>{servername}</strong> {log_desc} {servername}.
</div>
</div>
<div id="register" class="bigbutton" onclick="document.location.href='reg.php';"><font color="#cc0000">{log_toreg}</font></div>
<div id="text2">
<div id="text3">
<center><b><font color="#00cc00">{log_online}: </font>
<font color="#c6c7c6">{online_users}</font> - <font color="#00cc00">{log_lastreg}: </font>
<font color="#c6c7c6">{last_user}</font> - <font color="#00cc00">{log_numbreg}:</font> <font color="#c6c7c6">{users_amount}</font>
</b></center><br>
<a href="lang.php?Langs=pl"><img src="images/lang/pl.png" alt="PL" title="PL"></a> <a href="lang.php?Langs=fr"><img src="images/lang/fr.png" alt="FR" title="FR"></a> <a href="lang.php?Langs=es"><img src="images/lang/es.png" alt="ES" title="ES"></a> <a href="lang.php?Langs=de"><img src="images/lang/de.png" alt="DE" title="DE"></a> <a href="lang.php?Langs=en"><img src="images/lang/en.png" alt="EN" title="EN"></a> <a href="lang.php?Langs=it"><img src="images/lang/it.png" alt="IT" title="IT"></a>
</div>
</div>
</center>
</div>
<div id="text3">
<center><br>
<div style="text-align: left; color: white;"><big style="font-weight: bold; margin-left: 25px;"><big>{log_welcome} {servername}</big></big></div>
</center>
</div>
</div>
</div>
</body></html>