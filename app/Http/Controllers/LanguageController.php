<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function switch($lang)
    {
        if (in_array($lang, array_keys(getAvailableLanguages()))) {
            return redirect()
                ->route('index')
                ->cookie('xnova_language', $lang, 60 * 24 * 30);
        }

        return redirect()->route('index');
    }
}
