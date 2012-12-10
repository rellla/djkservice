<?php
/****************/
/* Mitglieder       */
/* mitglieder.php   */
/****************/

function get_mitglieder($params=null) {
	global $resturl;
	$i = 0;
    $arr = '';
	$where = "";
	$start = "0,";
	$arr["max_id"] = 0;

	if (isset($params["search_sql"])) {
		$search_sql = $params["search_sql"];
	}
	
	// build LIMIT, OFFSET phrase
	if (isset($params["start"])) {
		$start = $params["start"].", ";
	}
    $limit = " LIMIT ".$start."999";
	if (isset($params["amt"])) {
		$limit =" LIMIT ".$start.$params["amt"];
	}

	// build ORDER phrase
	if (isset($params["sort"])) {
		$order = " ORDER BY ".$params["sort"];
	} else {
		$order = " ORDER BY mid asc";
	}
	
	/*
	// build ORDER phrase
	if (isset($params["scol_name"])) {
		
		if (isset($params["sdir"])) {
			$order = " ORDER BY ".$params["scol_name"]." ".$params["sdir"];
		} else {
			$order = " ORDER BY ".$params["scol_name"]." asc";
		}
	} else {
		$order = " ORDER BY mid desc";
	} 
	*/
	
	
	// build query-string and execute query
	$query = "SELECT mid FROM mitglieder".$search_sql.$order.$limit;
//	$arr['query'] = "SELECT mid FROM mitglieder".$search_sql.$order.$limit;
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["mitglieder"][$i]["id"] = utf8_encode($line["mid"]);
		if ($line["mid"]>$arr["count_max_id"]) {
			$arr["count_max_id"]=(int)$line["mid"];
		}
		$arr["mitglieder"][$i]["link"] = $resturl."mitglieder/".utf8_encode($line["mid"]);
		$i++;
	}
	$arr["count_listed"] = (int)$i;
	mysql_free_result($result);
	
	$query = "SELECT COUNT(mid) as c FROM mitglieder".$search_sql;
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


function get_mitglied($id) {
    $arr = '';
	$query = "SELECT *,IF (DATE_FORMAT( CURDATE( ), '%m%d' ) >= DATE_FORMAT( geburtstag , '%m%d' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT(geburtstag, '%Y' ) , DATE_FORMAT( CURDATE( ) , '%Y' ) - DATE_FORMAT( geburtstag, '%Y' ) -1) AS alter_jahre FROM mitglieder LEFT JOIN status ON (status.id=mitglieder.status) LEFT JOIN beitraghv ON (beitraghv.id=mitglieder.beitraghv) LEFT JOIN beitragst ON (beitragst.id=mitglieder.beitragst) LEFT JOIN beitragt ON (beitragt.id=mitglieder.beitragt) WHERE mid = $id";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		foreach ($line as $key => $col_value) {
			if (map("mitglieder",$key)) {
				$arr[map("mitglieder",$key)] = utf8_encode($col_value);
			}
		}
	}
	return $arr;
}

function create_mitglied($input) {
	$arr = '';
    $json = json_decode($input);
	$neu = $json->neu;
	
	$mid = $json->ID;
	$vname = utf8_decode($json->Vorname);
	$nname = utf8_decode($json->Nachname);
	$strasse = $json->Strasse;
	$hausnr = $json->Hausnummer;
	$ort = $json->Ort;
	$fussball = (!$json->Fussball) ? 0 : $json->Fussball;
	$tennis = (!$json->Tennis) ? 0 : $json->Tennis;
	$stock = (!$json->Stock) ? 0 : $json->Stock;
	$gymnastik = (!$json->Gymnastik) ? 0 : $json->Gymnastik;
	$geschlecht = $json->Geschlecht;
	$geburtstag = format_date($json->Geburtsdatum);
	$eintritt = format_date($json->Eintritt);
	$status = $json->Status;
	$beitraghv = $json->BeitragHV;
	$beitragst = $json->BeitragST;
	$beitragt = $json->BeitragT;
	$firma = (!$json->Firma) ? 0 : $json->Firma;

	if ($neu == 1) {
		$arr["query"] = "INSERT INTO 
				mitglieder(mid,vname,nname,strasse,hausnr,ort,geschlecht,geburtstag,fussball,tennis,stock,gymnastik,status,beitraghv,beitragst,beitragt,eintritt,firma) 
				VALUES($mid,\"$vname\",\"$nname\",$strasse,\"$hausnr\",$ort,\"$geschlecht\",\"$geburtstag\",$fussball,$tennis,$stock,$gymnastik,$status,$beitraghv,$beitragst,$beitragt,\"$eintritt\",$firma)";
	} else {
		$arr["query"] = "UPDATE mitglieder SET 
			vname=\"$vname\",
			nname = \"$nname\",
			strasse = $strasse,
			hausnr = \"$hausnr\",
			ort = $ort,
			geschlecht = \"$geschlecht\",
			geburtstag = \"$geburtstag\",
			eintritt = \"$eintritt\",
			fussball = $fussball,
			tennis = $tennis,
			stock = $stock,
			gymnastik = $gymnastik,
			status = $status,
			beitraghv = $beitraghv,
			beitragst = $beitragst,
			beitragt = $beitragt,
			firma = $firma WHERE mid=$mid";
	}
	$arr["result"] = mysql_query($arr["query"]) or die ('Query failed: ' . mysql_error());
/*	while ($line = mysql_fetch_assoc($result)) {
		foreach ($line as $key => $col_value) {
			if (map("mitglieder",$key)) {
				$arr[map("mitglieder",$key)] = utf8_encode($col_value);
			}
		}
	}
*/	
	if ($arr["result"]) { 
		$arr["message"] = "Mitglied erfolgreich erfasst!"; 
	} else { 
		$arr["message"] = "Mitglied NICHT erfolgreich erfasst!";
	}
	return $arr;
}

function format_date($date) {
	$arr = preg_split("/\./", $date);
	$newdate = $arr[2]."-".$arr[1]."-".$arr[0];
	return $newdate;
}

?>