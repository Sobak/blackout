<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Utils\BBCodeUtils;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index', [
            'title' => trans('chat.title'),
        ]);
    }

    public function create(Request $request)
    {
        $chat = new Chat();
        $chat->user_id = auth()->id();
        $chat->message = trim(str_replace('+', 'plus', $request->get('msg')));
        $chat->timestamp = time();
        $chat->save();
    }

    public function messages()
    {
        $messages = Chat::with('user')->orderBy('id', 'desc')->get();

        $output = '';
        foreach ($messages as $message) {
            $content = BBCodeUtils::parse(htmlentities(utf8_decode($message->message)));
            $output .= '<div align="left">' . $message->user->username . ' > ' . $content .'<br></div>';
        }

        return $output;
    }
}
