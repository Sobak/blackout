<?php

defined('INSIDE') or die;

define('ADMINEMAIL'               , "admin@xnova.fr");
define('GAMEURL'                  , "http://".$_SERVER['HTTP_HOST']."/");

// World size settings
define('MAX_GALAXY_IN_WORLD'      , 9);
define('MAX_SYSTEM_IN_GALAXY'     , 499);
define('MAX_PLANET_IN_SYSTEM'     , 15);
// Number of colonies per spying report
define('SPY_REPORT_ROW'           , 2);
// Fields given by the moonbase
define('FIELDS_BY_MOONBASIS_LEVEL', 4);
// Maximum number of planets per player
define('MAX_PLAYER_PLANETS'       , 21);
// Maximum number of items in the building construction list
define('MAX_BUILDING_QUEUE_SIZE'  , 5);
// Maximum number of elements in a fleet build list line and defenses
define('MAX_FLEET_OR_DEFS_PER_ROW', 1000);
// Possible overrun rate in hangard storage space ...
// 1.0 for 100%, 1.1 for 110% etc...
define('MAX_OVERFLOW'             , 1.1);

// Base values for newly created colonies or planets
define('BASE_STORAGE_SIZE'        , 1000000);
define('BUILD_METAL'              , 500);
define('BUILD_CRISTAL'            , 500);
define('BUILD_DEUTERIUM'          , 500);

// Debug Level
define('DEBUG', 1); // Debugging off

// List of forbidden words
$ListCensure = ["<", ">", "script", "doquery", "http", "javascript"];
