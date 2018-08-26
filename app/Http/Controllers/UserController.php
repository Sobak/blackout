<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function forgotPassword()
    {
        return view('user.forgot_password', [
            'servername' => config('blackout.game_name'),
            'title' => trans('user.forgot_password.title'),
        ]);
    }

    public function forgotPasswordPost(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if ($user) {
            $newPassword = str_random(6);

            $user->password = bcrypt($newPassword);
            $user->save();

            Mail::to($user)->send(new PasswordReset($user, $newPassword));

            return show_message(trans('user.forgot_password.success'), trans('app.success'));
        }

        return show_message(trans('user.forgot_password.failure'), trans('app.error'));
    }

    public function login()
    {
        return view('user.login', [
            'forum_url' => config('blackout.forum_url'),
            'languages' => getAvailableLanguages(),
            'latest_player' => User::orderBy('register_time', 'desc')->first(['username'])['username'],
            'online_count' => User::where('onlinetime', '>', time() - 900)->count(),
            'servername' => config('blackout.game_name'),
            'total_players' => User::count(),
        ]);
    }

    public function loginPost(Request $request)
    {
        $credentials = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ];

        $remember = $request->get('rememberme') == 1;

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->to('overview.php');
        }

        return show_message(trans('user.login.error_text'), trans('app.error'));
    }

    public function logout()
    {
        Auth::logout();

        return show_message(trans('user.logout.message_text'), trans('user.logout.message_title'), 'login', 2);
    }
}
