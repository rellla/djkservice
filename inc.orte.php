<?php
/****************/
/* Routen       */
/* routen.php   */
/****************/

function get_orte($params=null) {
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
	$query = "SELECT id FROM orte".$where." ORDER BY id";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["orte"][$i]["id"] = utf8_encode($line["id"]);
		$arr["orte"][$i]["link"] = $resturl."orte/".utf8_encode($line["id"]);
		$i++;
	}
	$arr["count_query"] = (int)$i;
	mysql_free_result($result);
	
	$query = "SELECT COUNT(id) FROM orte".$where;
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
			$arr["count_all"] = (int)$line["COUNT(id)"];
	}

	return $arr;
}


function get_ort($id) {
	global $resturl;
    $arr = '';
	$i = 0;
	
	$query = "SELECT id,plz,ortname,ortsteil FROM orte WHERE id = $id ORDER BY id";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["Ort"]["id"] = utf8_encode($line["id"]);
		$arr["Ort"]["PLZ"] = utf8_encode($line["plz"]);	
		$arr["Ort"]["Ortsname"] = utf8_encode($line["ortname"]);
		$arr["Ort"]["Ortsteil"] = utf8_encode($line["ortsteil"]);
		
		$i++;
	}
	$arr["count_all"] = $i;
	return $arr;
}
?>