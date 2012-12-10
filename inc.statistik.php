<?php
/****************/
/* Statistik       */
/* statistik.php   */
/****************/

function get_statistik($params=null) {
	global $resturl;
	$i = 0;
    $arr = '';

/***************************************
// Queries:
*/
	$query["Gesamtmitglieder"] = "SELECT COUNT(mid) as c FROM mitglieder";
	$query["Gesamtmitglieder_aktiv"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE (status=1 OR status=2)";
	$query["Gesamtmitglieder_aktiv_m"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE geschlecht='m' AND (status=1 OR status=2)";
	$query["Gesamtmitglieder_aktiv_w"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE geschlecht='w' AND (status=1 OR status=2)";
	$query["Fussballmitglieder"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE fussball=1 AND (status=1 OR status=2)";
	$query["Fussballmitglieder_m"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE fussball=1 AND (status=1 OR status=2) AND geschlecht='m'";
	$query["Fussballmitglieder_w"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE fussball=1 AND (status=1 OR status=2) AND geschlecht='w'";
	$query["Tennismitglieder"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE tennis=1 AND (status=1 OR status=2)";
	$query["Tennismitglieder_m"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE tennis=1 AND (status=1 OR status=2) AND geschlecht='m'";
	$query["Tennismitglieder_w"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE tennis=1 AND (status=1 OR status=2) AND geschlecht='w'";
	$query["Stockmitglieder"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE stock=1 AND (status=1 OR status=2)";
	$query["Stockmitglieder_m"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE stock=1 AND (status=1 OR status=2) AND geschlecht='m'";
	$query["Stockmitglieder_w"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE stock=1 AND (status=1 OR status=2) AND geschlecht='w'";
	$query["Gymnastikmitglieder"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE gymnastik=1 AND (status=1 OR status=2)";
	$query["Gymnastikmitglieder_m"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE gymnastik=1 AND (status=1 OR status=2) AND geschlecht='m'";
	$query["Gymnastikmitglieder_w"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE gymnastik=1 AND (status=1 OR status=2) AND geschlecht='w'";
	
	$query["BeitragHV4500"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE beitraghv=1";
	$query["BeitragHV2250"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE beitraghv=2";
	$query["BeitragHV1900"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE beitraghv=3";
	$query["BeitragHV1200"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE beitraghv=4";
	$query["BeitragHV0000"] = "SELECT COUNT(mid) as c FROM mitglieder WHERE beitraghv=5";

	$query["Alter0005"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2)) as aa WHERE alter_jahre<6";
	$query["Alter0613"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2)) as aa WHERE alter_jahre>5 AND alter_jahre<14";
	$query["Alter1417"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2)) as aa WHERE alter_jahre>13 AND alter_jahre<18";
	$query["Alter1826"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2)) as aa WHERE alter_jahre>17 AND alter_jahre<27";
	$query["Alter2740"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2)) as aa WHERE alter_jahre>26 AND alter_jahre<41";
	$query["Alter4160"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2)) as aa WHERE alter_jahre>40 AND alter_jahre<61";
	$query["Alter6199"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2)) as aa WHERE alter_jahre>60";

	$query["Alter0005_w"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='w') as aa WHERE alter_jahre<6";
	$query["Alter0613_w"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='w') as aa WHERE alter_jahre>5 AND alter_jahre<14";
	$query["Alter1417_w"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='w') as aa WHERE alter_jahre>13 AND alter_jahre<18";
	$query["Alter1826_w"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='w') as aa WHERE alter_jahre>17 AND alter_jahre<27";
	$query["Alter2740_w"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='w') as aa WHERE alter_jahre>26 AND alter_jahre<41";
	$query["Alter4160_w"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='w') as aa WHERE alter_jahre>40 AND alter_jahre<61";
	$query["Alter6199_w"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='w') as aa WHERE alter_jahre>60";
	
	$query["Alter0005_m"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='m') as aa WHERE alter_jahre<6";
	$query["Alter0613_m"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='m') as aa WHERE alter_jahre>5 AND alter_jahre<14";
	$query["Alter1417_m"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='m') as aa WHERE alter_jahre>13 AND alter_jahre<18";
	$query["Alter1826_m"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='m') as aa WHERE alter_jahre>17 AND alter_jahre<27";
	$query["Alter2740_m"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='m') as aa WHERE alter_jahre>26 AND alter_jahre<41";
	$query["Alter4160_m"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='m') as aa WHERE alter_jahre>40 AND alter_jahre<61";
	$query["Alter6199_m"] = "SELECT COUNT(alter_jahre) FROM (SELECT IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder WHERE (status=1 OR status=2) AND geschlecht='m') as aa WHERE alter_jahre>60";

	
	
	foreach ($query as $t => $q) {
		$result = mysql_query($q) or die ('Query failed: ' . mysql_error());
		while ($line = mysql_fetch_assoc($result)) {
			foreach ($line as $key => $value) {
				$arr["Statistik"]["absolut"][$t] = (int)$value;
			}
		}
		mysql_free_result($result);
	}
	$arr["Statistik"]["relativ"] = to_relative($arr["Statistik"]["absolut"],$arr["Statistik"]["absolut"]["Gesamtmitglieder_aktiv"]);
	return $arr;
}

function to_relative($array_abs,$gesamt) {
	foreach ($array_abs as $key => $value) {
		$array[$key] = round($value/$gesamt*100,2);
	}	
	return $array;
}
?>