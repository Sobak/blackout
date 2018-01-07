<?php

/**
 * Sends email message.
 *
 * @param $to
 * @param $subject
 * @param $body
 * @param string $from
 *
 * @return bool
 */
function SendEmail($to, $subject, $body, $from = '') {
    $from = trim($from);

    if (!$from) {
        $from = ADMINEMAIL;
    }

    $head   = '';
    $head  .= "Content-Type: text/plain \r\n";
    $head  .= "Date: " . date('r') . " \r\n";
    $head  .= "Return-Path: " . ADMINEMAIL . " \r\n";
    $head  .= "From: $from \r\n";
    $head  .= "Sender: $from \r\n";
    $head  .= "Reply-To: $from \r\n";
    $head  .= "X-Sender: $from \r\n";
    $head  .= "X-Priority: 3 \r\n";
    $body   = str_replace("\r\n", "\n", $body);
    $body   = str_replace("\n", "\r\n", $body);

    return mail($to, $subject, $body, $head);
}
