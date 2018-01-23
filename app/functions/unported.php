<?php

/**
 * Fetches all languages available.
 */
function getAvailableLanguages()
{
    $languages = [];

    foreach (glob(base_path('legacy/language/*/lang_info.php')) as $langInfoFile) {
        require $langInfoFile;

        $langKey = array_pop(explode('/', dirname($langInfoFile)));

        /** @noinspection PhpUndefinedVariableInspection */
        $languages[$langKey] = $langInfos['DISPLAY_NAME'];
    }

    return $languages;
}

/**
 * Fetches all skins available.
 */
function getAvailableSkins()
{
    $skins = [];

    foreach (glob(public_path('skins/*'), GLOB_ONLYDIR) as $skin) {
        $skins[] = array_pop(explode('/', $skin));
    }

    return $skins;
}
