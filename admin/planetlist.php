<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_SUPER_OPERATOR);

$parse = $lang;
$query = doquery("SELECT * FROM {{table}} WHERE planet_type='1'", "planets");
$i = 0;
while ($u = mysql_fetch_array($query)) {
    $parse['planetes'] .= "<tr>"
    . "<td class=b><center><b>" . $u[0] . "</center></b></td>"
    . "<td class=b><center><b>" . $u[1] . "</center></b></td>"
    . "<td class=b><center><b>" . $u[4] . "</center></b></td>"
    . "<td class=b><center><b>" . $u[5] . "</center></b></td>"
    . "<td class=b><center><b>" . $u[6] . "</center></b></td>"
    . "</tr>";
    $i++;
}

if ($i == "1")
    $parse['planetes'] .= "<tr><th class=b colspan=5>Il y a qu'une seule plan&egrave;te</th></tr>";
else
    $parse['planetes'] .= "<tr><th class=b colspan=5>Il y a {$i} plan&egrave;tes</th></tr>";

display(parsetemplate(gettemplate('admin/planetlist_body'), $parse), 'Planetlist', false);
