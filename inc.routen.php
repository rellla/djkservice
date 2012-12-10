<?php
/****************/
/* Routen       */
/* routen.php   */
/****************/

function get_routen($params=null) {
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
	$query = "SELECT DISTINCT route FROM strassen".$where." ORDER BY route";
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
		$arr["routen"][$i]["id"] = utf8_encode($line["route"]);
		$arr["routen"][$i]["link"] = $resturl."routen/".utf8_encode($line["route"]);
		$i++;
	}
	$arr["count_query"] = (int)$i;
	mysql_free_result($result);
	
	$query = "SELECT COUNT(DISTINCT route) FROM strassen".$where;
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	while ($line = mysql_fetch_assoc($result)) {
			$arr["count_all"] = (int)$line["COUNT(DISTINCT route)"];
	}

	return $arr;
}


function get_route($id) {
	global $resturl;
    $arr = '';
	$i = 0;
	if ($id == "firma" || $id == "alle") {
	$query = "SELECT strname,sid FROM strassen ORDER BY strname";
		$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
		while ($line = mysql_fetch_assoc($result)) {
			$arr["Strassen"][$i]["id"] = utf8_encode($line["sid"]);
			$arr["Strassen"][$i]["link"] = $resturl."strassen/".utf8_encode($line["sid"]);	
			$i++;
		}
	} else {
		$query = "SELECT strname,sid FROM strassen WHERE route = $id ORDER BY strname";
		$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
		while ($line = mysql_fetch_assoc($result)) {
			$arr["Strassen"][$i]["id"] = utf8_encode($line["sid"]);
			$arr["Strassen"][$i]["link"] = $resturl."strassen/".utf8_encode($line["sid"]);	
			$i++;
		}
	}
	$arr["count_all"] = $i;
	return $arr;
}

?>