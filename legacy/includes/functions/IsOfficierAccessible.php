<?php

/**
 * Check whether an officer can be recruited.
 *
 * Returns one of:
 *  * 0 for unmet requirements
 *  * 1 when everything is fine
 *  * -1 when requirements are met but user already has maximum
 *    level officer of that type
 *
 * @param array $CurrentUser User's database record
 * @param integer $Officier An officer ID
 *
 * @return int
 */
function IsOfficierAccessible($CurrentUser, $Officier)
{
    global $requeriments, $resource, $pricelist;

    if (isset($requeriments[$Officier])) {
        $enabled = true;
        foreach($requeriments[$Officier] as $ReqOfficier => $OfficierLevel) {
            if ($CurrentUser[$resource[$ReqOfficier]] &&
                $CurrentUser[$resource[$ReqOfficier]] >= $OfficierLevel) {
                $enabled = 1;
            } else {
                return 0;
            }
        }
    }
    if ($CurrentUser[$resource[$Officier]] < $pricelist[$Officier]['max']  ) {
        return 1;
    }

    return -1;
}
