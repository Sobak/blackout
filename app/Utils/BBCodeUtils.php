<?php

namespace App\Utils;

class BBCodeUtils
{
    public static function parse($text)
    {
        // Basic text formatting
        $text = preg_replace("#\[b\](.+)\[/b\]#isU", '<b>$1</b>', $text);
        $text = preg_replace("#\[i\](.+)\[/i\]#isU", '<i>$1</i>', $text);
        $text = preg_replace("#\[u\](.+)\[/u\]#isU", '<u>$1</u>', $text);
        $text = preg_replace("#\[c=(blue|yellow|green|pink|red|orange)\](.+)\[/c\]#isU", '<font color="$1">$2</font>', $text);

        // Smileys
        $smileys = [
            '#:c#isU' => '<img src="images/smileys/cry.png" align="absmiddle" alt=":c">',
            '#:/#isU' => '<img src="images/smileys/confused.png" align="absmiddle" alt=":/">',
            '#o0#isU' => '<img src="images/smileys/dizzy.png" align="absmiddle" alt="o0">',
            '#\^\^#isU' => '<img src="images/smileys/happy.png" align="absmiddle" alt="^^">',
            '#:D#isU' => '<img src="images/smileys/lol.png" align="absmiddle" alt=":D">',
            '#:\|#isU' => '<img src="images/smileys/neutral.png" align="absmiddle" alt=":|">',
            '#:\)#isU' => '<img src="images/smileys/smile.png" align="absmiddle" alt=":)">',
            '#:o#isU' => '<img src="images/smileys/omg.png" align="absmiddle" alt=":o">',
            '#:p#isU' => '<img src="images/smileys/tongue.png" align="absmiddle" alt=":p">',
            '#:\(#isU' => '<img src="images/smileys/sad.png" align="absmiddle" alt=":(">',
            '#;\)#isU' => '<img src="images/smileys/wink.png" align="absmiddle" alt=";)">',
            '#:s#isU' => '<img src="images/smileys/shit.png" align="absmiddle" alt=":s">',
        ];

        $text = preg_replace(array_keys($smileys), array_values($smileys), $text);

        // URLs
        $text = preg_replace("#\[url=(ft|https?://)(.+)\](.+)\[/url\]#isU", '<a href="$1$2" target="_blank">$3</a>', $text);

        return $text;
    }
}
