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
