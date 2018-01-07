<!doctype html>
<html>
<head>
    <title>{servername}</title>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="skins/xnova/formate.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/about.css">
</head>
<body>
  <div id="main">
    <div id="login">
        <div id="login_input">
            <table border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr style="vertical-align: top;">
                        <td style="padding-right: 4px;">
                            <form action="" method="post" style="margin-top: -9px; margin-left: 70px;">
                                {User_name} <input name="username" value="" type="text">
                                {Password} <input name="password" value="" type="password"><br>
                                {Remember_me} <input name="rememberme" type="checkbox">
                                <input name="submit" value="{Login}" type="submit">
                            </form>
                            <a href="lostpassword.php">{PasswordLost}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="mainmenu">
        <a href="reg.php">{log_reg}</a>
        <a href="{forum_url}">Forum</a>
        <a href="contact.php">Contact</a>
        <a href="credit.php">{log_cred}</a>
    </div>
    <div id="rightmenu" class="rightmenu">
        <div id="content">
            <center>
                <div style="text-align: left;">
                    <strong>{servername}</strong> {log_desc} {servername}.
                </div>
                <div id="register" class="bigbutton" onclick="document.location.href='reg.php';"><font color="#cc0000">{log_toreg}</font></div>
                <div id="text2">
                    <center>
                        <b><font color="#00cc00">{log_online}: </font>
                        <font color="#c6c7c6">{online_users}</font> - <font color="#00cc00">{log_lastreg}: </font>
                        <font color="#c6c7c6">{last_user}</font> - <font color="#00cc00">{log_numbreg}:</font> <font color="#c6c7c6">{users_amount}</font>
                        </b>
                    </center><br>
                    {languages}
                </div>
            </center>
        </div>
        <center><br>
            <div style="text-align: left; color: white;"><big style="font-weight: bold; margin-left: 25px;"><big>{log_welcome} {servername}</big></big></div>
        </center>
    </div>
  </div>
</body>
</html>
