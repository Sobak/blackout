<?php

/**
 * strings.php
 *
 * @version 1.0
 * @copyright 2008 by ??????? for XNova
 */

function colorNumber($n, $s = '') {
    if ($n > 0) {
        if ($s != '') {
            $s = colorGreen($s);
        } else {
            $s = colorGreen($n);
        }
    } elseif ($n < 0) {
        if ($s != '') {
            $s = colorRed($s);
        } else {
            $s = colorRed($n);
        }
    } else {
        if ($s != '') {
            $s = $s;
        } else {
            $s = $n;
        }
    }
    return $s;
}

function colorGreen($n) {
    return '<font color="#00ff00">' . $n . '</font>';
}

// Created by Perberos. All rights reversed (C) 2006
?>