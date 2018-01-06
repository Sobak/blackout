<?php

/**
 * GalaxyRowPlanet.php
 *
 * @version 1.0
 * @copyright 2008 By Chlorel for XNova
 */

function GalaxyRowPlanet ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowUser, $Galaxy, $System, $Planet, $PlanetType ) {
	global $lang, $dpath, $user, $HavePhalanx, $CurrentSystem, $CurrentGalaxy;

	// Planete (Image)
	$Result  = "<th width=30>";

	$GalaxyRowUser = doquery("SELECT * FROM {{table}} WHERE id='".$GalaxyRowPlanet['id_owner']."';", 'users', true);
	if ($GalaxyRow && $GalaxyRowPlanet["destruyed"] == 0 && $GalaxyRow["id_planet"] != 0) {
		if ($HavePhalanx <> 0) {
			if ($GalaxyRowUser['id'] != $user['id']) {
				if ($GalaxyRowPlanet["galaxy"] == $CurrentGalaxy) {
					$Range = GetPhalanxRange ( $HavePhalanx );
					if ($SystemLimitMin < 1) {
						$SystemLimitMin = 1;
					}
					$SystemLimitMax = $CurrentSystem + $Range;
					if ($System <= $SystemLimitMax) {
						if ($System >= $SystemLimitMin) {
							$PhalanxTypeLink = "<a href=# onclick=fenster(&#039;phalanx.php?galaxy=".$Galaxy."&amp;system=".$System."&amp;planet=".$Planet."&amp;planettype=".$PlanetType."&#039;) >".$lang['gl_phalanx']."</a><br />";
						} else {
							$PhalanxTypeLink = "";
						}
					} else {
						$PhalanxTypeLink = "";
					}
				} else {
					$PhalanxTypeLink = "";
				}
			} else {
				$PhalanxTypeLink = "";
			}
		} else {
			$PhalanxTypeLink = "";
		}

		if ($GalaxyRowUser['id'] != $user['id']) {
			$MissionType6Link = "<a href=# onclick=&#039javascript:doit(6, ".$Galaxy.", ".$System.", ".$Planet.", ".$PlanetType.", ".$user["spio_anz"].");&#039 >". $lang['type_mission'][6] ."</a><br /><br />";
		} elseif ($GalaxyRowUser['id'] == $user['id']) {
			$MissionType6Link = "";
		}
		if ($GalaxyRowUser['id'] != $user['id']) {
			$MissionType1Link = "<a href=fleet.php?galaxy=".$Galaxy."&amp;system=".$System."&amp;planet=".$Planet."&amp;planettype=".$PlanetType."&amp;target_mission=1>". $lang['type_mission'][1] ."</a><br />";
		} elseif ($GalaxyRowUser['id'] == $user['id']) {
			$MissionType1Link = "";
		}
		if ($GalaxyRowUser['id'] != $user['id']) {
			$MissionType5Link = "<a href=fleet.php?galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&planettype=".$PlanetType."&target_mission=5>". $lang['type_mission'][5] ."</a><br />";
		} elseif ($GalaxyRowUser['id'] == $user['id']) {
			$MissionType5Link = "";
		}
		if ($GalaxyRowUser['id'] == $user['id']) {
			$MissionType4Link = "<a href=fleet.php?galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&planettype=".$PlanetType."&target_mission=4>". $lang['type_mission'][4] ."</a><br />";
		} elseif ($GalaxyRowUser['id'] != $user['id']) {
			$MissionType4Link = "";
		}
		$MissionType3Link = "<a href=fleet.php?galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&planettype=".$PlanetType."&target_mission=3>". $lang['type_mission'][3] ."</a>";

		$Result .= "<a style=\"cursor: pointer;\"";
		$Result .= " onmouseover='return overlib(\"";
		$Result .= "<table width=240>";
		$Result .= "<tr>";
		$Result .= "<td class=c colspan=2>";
		$Result .= $lang['gl_planet'] ." ". $GalaxyRowPlanet["name"] ." [".$Galaxy.":".$System.":".$Planet."]";
		$Result .= "</td>";
		$Result .= "</tr>";
		$Result .= "<tr>";
		$Result .= "<th width=80>";
		$Result .= "<img src=". $dpath ."planeten/small/s_". $GalaxyRowPlanet["image"] .".jpg height=75 width=75 />";
		$Result .= "</th>";
		$Result .= "<th align=left>";
		$Result .= $MissionType6Link;
		$Result .= $PhalanxTypeLink;
		$Result .= $MissionType1Link;
		$Result .= $MissionType5Link;
		$Result .= $MissionType4Link;
		$Result .= $MissionType3Link;
		$Result .= "</th>";
		$Result .= "</tr>";
		$Result .= "</table>\"";
//		$Result .= ", STICKY, MOUSEOFF, DELAY, ". ($user["settings_tooltiptime"] * 1000) .", CENTER, OFFSETX, -40, OFFSETY, -40 );'";
		$Result .= ", STICKY, MOUSEOFF, DELAY, 750, CENTER, OFFSETX, -40, OFFSETY, -40 );'";
		$Result .= " onmouseout='return nd();'>";
		$Result .= "<img src=".	$dpath ."planeten/small/s_". $GalaxyRowPlanet["image"] .".jpg height=30 width=30>";
//		$Result .= $GalaxyRowPlanet["name"];
		$Result .= "</a>";
	}
	$Result .= "</th>";

	return $Result;
}
?>