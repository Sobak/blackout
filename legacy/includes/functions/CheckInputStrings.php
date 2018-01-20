<?php

/**
 * CheckInputStrings.php
 *
 * @version 1.0
 * @copyright 2008 By Chlorel for XNova
 */

function CheckInputStrings ( $String ) {
    global $ListCensure;

    return str_replace($ListCensure, '*', $String);
}
?>