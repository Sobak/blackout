<?php

define('INSIDE', true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_SUPER_OPERATOR);

$type = isset($_GET['type']) && $_GET['type'] == 'moons' ? 'moons' : 'planets';

includeLang('admin/colonies');
$parse = $lang;

$rowTPL = gettemplate('admin/colonies_row');

if ($type == 'planets') {
    $parse['col_mother_planet'] = '';
    $parse['title'] = $lang['title_planets'];
    $planetType = 1;
} else {
    $parse['col_mother_planet'] = '<th>' . $lang['col_mother_planet'] . '</th>';
    $parse['title'] = $lang['title_moons'];
    $planetType = 3;
}

$query = doquery("SELECT * FROM {{table}} WHERE planet_type='$planetType'", "planets");

while ($row = mysql_fetch_array($query)) {
    if ($type == 'moons') {
        $row['mother_planet'] = '<td class="b"><center><b>' . $row['id_owner'] . '</b></center></td>';
    }

    $parse['rows'] .= parsetemplate($rowTPL, $row);
}

$parse['count'] = mysql_num_rows($query);

display(parsetemplate(gettemplate('admin/colonies_body'), $parse), $parse['title'], false);
