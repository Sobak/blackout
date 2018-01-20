<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function forgotPassword()
    {
        return view('user.forgot_password', [
            'servername' => game_config('game_name'),
            'title' => trans('user.forgot_password.title'),
        ]);
    }

    public function forgotPasswordPost(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if ($user) {
            $newPassword = str_random(6);

            $user->password = md5($newPassword);
            $user->save();

            Mail::to($user)->send(new PasswordReset($user, $newPassword));

            return show_message(trans('user.forgot_password.success'), trans('app.success'));
        }

        return show_message(trans('user.forgot_password.failure'), trans('app.error'));
    }

    public function login()
    {
        return view('user.login', [
            'forum_url' => game_config('forum_url'),
            'languages' => getAvailableLanguages(),
            'latest_player' => User::orderBy('register_time', 'desc')->first(['username'])['username'],
            'online_count' => User::where('onlinetime', '>', time() - 900)->count(),
            'servername' => game_config('game_name'),
            'total_players' => User::count(),
        ]);
    }

    public function loginPost(Request $request)
    {
        $user = User::where('username', $request->get('username'))
                    ->where('password', md5($request->get('password')))
                    ->first();

        if ($user) {
            if ($request->get('rememberme') == 1) {
                $expiretime = time() + 31536000;
                $rememberme = 1;
            } else {
                $expiretime = 0;
                $rememberme = 0;
            }

            $cookie = $user["id"] . "/%/" . $user["username"] . "/%/" . md5($user["password"] . "--" . config('auth.cookie_key')) . "/%/" . $rememberme;
            setcookie(game_config('COOKIE_NAME'), $cookie, $expiretime, "/", "", 0);

            return redirect()->to('overview.php');
        }

        return show_message(trans('user.login.error_text'), trans('app.error'));
    }
}
