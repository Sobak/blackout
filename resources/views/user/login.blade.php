<!doctype html>
<html>
<head>
    <title>{{ $servername }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ skin_asset('formate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
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
                            @lang('user.login.username') <input name="username" value="" type="text">
                            @lang('user.login.password') <input name="password" value="" type="password"><br>
                            @lang('user.login.remember_me') <input name="rememberme" type="checkbox">
                            {{ csrf_field() }}
                            <input name="submit" value="@lang('user.login.submit')" type="submit">
                        </form>
                        <a href="{{ route('user.forgot-password') }}">@lang('user.login.forgot_password')</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="mainmenu">
        <a href="reg.php">@lang('user.login.menu.register')</a>
        <a href="{{ $forum_url }}">Forum</a>
        <a href="contact.php">Contact</a>
        <a href="credit.php">@lang('user.login.menu.credits')</a>
    </div>
    <div id="rightmenu" class="rightmenu">
        <div id="login_content">
            <center>
                <div style="text-align: left;">
                    <strong>{{ $servername }}</strong> @lang('user.login.description') {{ $servername }}.
                </div>
                <div id="register" class="bigbutton" onclick="document.location.href='reg.php';"><font color="#cc0000">@lang('user.login.register')</font></div>
                <div id="text2">
                    <center>
                        <b><font color="#00cc00">@lang('user.login.players_online'): </font>
                            <font color="#c6c7c6">{{ $online_count }}</font> - <font color="#00cc00">@lang('user.login.player_latest'): </font>
                            <font color="#c6c7c6">{{ $latest_player }}</font> - <font color="#00cc00">@lang('user.login.players_total'):</font> <font color="#c6c7c6">{{ $total_players }}</font>
                        </b>
                    </center><br>
                    @foreach ($languages as $key => $name)
                        <a href="lang.php?=lang={{ $key }}">
                            <img src="images/lang/{{ $key }}.png" alt="{{ $name }}">
                        </a>
                    @endforeach
                </div>
            </center>
        </div>
        <center><br>
            <div style="text-align: left; color: white;"><big style="font-weight: bold; margin-left: 25px;"><big>@lang('user.login.welcome') {{ $servername }}</big></big></div>
        </center>
    </div>
</div>
</body>
</html>
