<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public static function send($recipientID, $senderID, $senderName, $type, $subject, $body, $time = null)
    {
        $message = new Message();
        $message->message_owner = $recipientID;
        $message->message_sender = $senderID;
        $message->message_from = $senderName;
        $message->message_type = $type;
        $message->message_subject = $subject;
        $message->message_text = $body;
        $message->message_time = $time ?? time();

        return $message->save();
    }
}
