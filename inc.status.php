<?php
/****************/
/* Routen       */
/* routen.php   */
/****************/

function get_stati($params=null) {
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
	$query = "SELECT id FROM status".$where." ORDER BY id";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["stati"][$i]["id"] = utf8_encode($line["id"]);
		$arr["stati"][$i]["link"] = $resturl."status.php/".utf8_encode($line["id"]);
		$i++;
	}
	$arr["count_query"] = (int)$i;
	mysql_free_result($result);
	
	$query = "SELECT COUNT(id) FROM status".$where;
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
			$arr["count_all"] = (int)$line["COUNT(id)"];
	}

	return $arr;
}


function get_status($id) {
	global $resturl;
    $arr = '';
	$i = 0;
	
	$query = "SELECT id,statusbez FROM status WHERE id = $id ORDER BY id";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["Status"]["id"] = utf8_encode($line["id"]);
		$arr["Status"]["Status"] = utf8_encode($line["statusbez"]);	
		$i++;
	}
	$arr["count_all"] = $i;
	return $arr;
}
?>