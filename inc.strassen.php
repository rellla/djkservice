<?php
/****************/
/* Routen       */
/* routen.php   */
/****************/

function get_strassen($params=null) {
	global $resturl;
	$i = 0;
    $arr = '';
	$where = "";

	// build WHERE phrase
	if (isset($params["where"])) {
		$where .= " WHERE 1 ";
		foreach ($params["where"] as $key => $value) {
			$where .= "AND ".$key."=\"".$value."\" ";
		}
	}

	// build query-string and execute query
	$query = "SELECT sid,strname,route FROM strassen".$where." ORDER BY sid";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["strassen"][$i]["id"] = utf8_encode($line["sid"]);
		$arr["strassen"][$i]["link"] = $resturl."strassen/".utf8_encode($line["sid"]);
		$i++;
	}
	$arr["count_query"] = (int)$i;
	mysql_free_result($result);
	
	$query = "SELECT COUNT(sid) FROM strassen".$where;
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
			$arr["count_all"] = (int)$line["COUNT(sid)"];
	}

	return $arr;
}


function get_strasse($id) {
	global $resturl;
    $arr = '';
	$i = 0;
	
	$query = "SELECT sid,strname,route FROM strassen WHERE sid = $id ORDER BY sid";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["Strasse"]["id"] = utf8_encode($line["sid"]);
		$arr["Strasse"]["Name"] = utf8_encode($line["strname"]);	
		$arr["Strasse"]["Route"] = utf8_encode($line["route"]);
		$arr["Strasse"]["Mitglieder"] = $resturl."strassen/".utf8_encode($line["sid"])."/mitglieder";
		
		$i++;
	}
	$arr["count_all"] = $i;
	return $arr;
}

function get_strassenmitglieder($id) {
	global $resturl;
    $arr = '';
	$i = 0;

	$query = "SELECT m.mid FROM mitglieder AS m LEFT JOIN strassen AS s ON (m.strasse=s.sid) WHERE s.sid = $id ORDER BY CAST(m.hausnr AS UNSIGNED),m.nname";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["Mitglieder"][$i]["id"] = utf8_encode($line["mid"]);
		$arr["Mitglieder"][$i]["link"] = $resturl."mitglieder/".utf8_encode($line["mid"]);	
		$i++;
	}
	$arr["count_all"] = $i;
	return $arr;
}

?>