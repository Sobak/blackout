<?php

return [
    'twig' => [
        'extension' => 'tpl',

        'environment' => [
            'debug' => config('app.debug'),

            'charset' => 'utf-8',

            'base_template_class' => 'TwigBridge\Twig\Template',

            // An absolute path where to store the compiled templates, or false
            // to disable caching. If null then cache file path is used.
            // default: cache file storage path
            'cache' => null,

            // When developing with Twig, it's useful to recompile the template
            // whenever the source code changes. If you don't provide a value
            // for the auto_reload option, it will be determined automatically based on the debug value.
            'auto_reload' => true,

            // If set to false, Twig will silently ignore invalid variables
            // (variables and or attributes/methods that do not exist) and
            // replace them with a null value. When set to true, Twig throws an exception instead.
            // default: false
            'strict_variables' => false,

            // If set to true, auto-escaping will be enabled by default for all templates.
            // default: 'html'
            'autoescape' => false,

            // A flag that indicates which optimizations to apply
            // (default to -1 -- all optimizations are enabled; set it to 0 to disable)
            'optimizations' => -1,
        ],

        'globals' => [],
    ],

    'extensions' => [
        'enabled' => [
            'TwigBridge\Extension\Loader\Facades',
            'TwigBridge\Extension\Loader\Filters',
            'TwigBridge\Extension\Loader\Functions',

            'TwigBridge\Extension\Laravel\Auth',
            'TwigBridge\Extension\Laravel\Config',
            'TwigBridge\Extension\Laravel\Dump',
            'TwigBridge\Extension\Laravel\Input',
            'TwigBridge\Extension\Laravel\Session',
            'TwigBridge\Extension\Laravel\Str',
            'TwigBridge\Extension\Laravel\Translator',
            'TwigBridge\Extension\Laravel\Url',
        ],

        'facades' => [],

        'functions' => [
            'head',
            'last',
        ],

        'filters' => [
            'get' => 'data_get',
        ],
    ],
];
