<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include( $ugamela_root_path . 'extension.inc' );
include( $ugamela_root_path . 'common.php' );

restrictAccess($user, LEVEL_OPERATOR);

if ( $CurrentUser['authlevel'] >= 1 ) {
                $PageTpl = gettemplate( "admin/deletuser" );

                if ( $mode != "delet" ) {
                                $parse['adm_bt_delet'] = $lang['adm_bt_delet'];
                }

        $Page = parsetemplate( $PageTpl, $parse );
        display ( $Page, $lang['adminpanel'], false, '', true );
}
