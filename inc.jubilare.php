<?php
/****************/
/* Mitglieder       */
/* mitglieder.php   */
/****************/

function get_jubilare($params=null) {
	global $resturl;
	$i=0;
	
	$query = "SELECT jalter FROM jubilaeum ORDER BY jalter";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$jubilaeum[$i] = $line["jalter"];
		$i++;
	}
	
	for ($i=0;$i<count($jubilaeum);$i++) {
//	for ($i=0;$i<1;$i++) { // for debug!
		$arr["jubilare"][$i]["id"] = ($jubilaeum[$i]-1);
		$arr["jubilare"][$i]["link"] = $resturl."jubilare/".($jubilaeum[$i]-1);
	}

	$arr["count_query"] = $i;
	$arr["count_all"] = count($jubilaeum);

	return $arr;
}

function get_jubilar($alter) {
	global $resturl;
	$i=0;
    $arr = '';
	$query = "SELECT mid FROM (SELECT *,IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder) AS mit WHERE mit.alter_jahre=".$alter." ORDER BY geburtstag";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["mitglieder"][$i]["id"] = $line["mid"];
		$arr["mitglieder"][$i]["link"] = $resturl."mitglieder/".$line["mid"];
		$i++;
	}
	mysql_free_result($result);
	
	$query = "SELECT COUNT(mid) as c FROM (SELECT *,IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder) AS mit WHERE mit.alter_jahre=".$alter;
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		foreach ($line as $key => $col_value) {
			$arr["count_query"] = (int)($col_value);
		}
	}
	mysql_free_result($result);

	$query = "SELECT COUNT(mid) FROM mitglieder";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		foreach ($line as $key => $col_value) {
			$arr["count_all"] = (int)($col_value);
		}
	}
	
	return $arr;
}

?>