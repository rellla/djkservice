<?php
/****************/
/* Routen       */
/* routen.php   */
/****************/

function get_beitraege($params=null) {
	global $resturl;
	$i = 0;
    $arr = '';

	$abt = array("hv","t","st");
	
	foreach ($abt as $str) {
		$arr["beitraege"][$i]["id"] = $str;
		$arr["beitraege"][$i]["link"] = $resturl."beitraege.php/".$str;
		$i++;
	}
	$arr["count_query"] = (int)$i;
	$arr["count_all"] = (int)$i;

	return $arr;
}


function get_beitrag($abt) {
	global $resturl;
    $arr = '';
	$i = 0;

	switch ($abt) {
		case "hv":
			$query = "SELECT * FROM beitraghv ORDER by id";
			$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
			while ($line = mysql_fetch_assoc($result)) {
				$arr["Beitrag"][$i]["id"] = utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["link"] = $resturl."beitraege.php/hv/".utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["Bezeichnung"] = utf8_encode($line["beitragsbezhv"]);	
				$arr["Beitrag"][$i]["Betrag"] = utf8_encode($line["beitraghv"]);	
				$i++;
			}
			$arr["count_all"] = $i;
			return $arr;
			break;
		case "t":
			$query = "SELECT * FROM beitragt ORDER by id";
			$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
			while ($line = mysql_fetch_assoc($result)) {
				$arr["Beitrag"][$i]["id"] = utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["link"] = $resturl."beitraege.php/t/".utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["Bezeichnung"] = utf8_encode($line["beitragsbezt"]);	
				$arr["Beitrag"][$i]["Betrag"] = utf8_encode($line["beitragt"]);	
				$i++;
			}
			$arr["count_all"] = $i;
			return $arr;
			break;
		case "st":
			$query = "SELECT * FROM beitragst ORDER by id";
			$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
			while ($line = mysql_fetch_assoc($result)) {
				$arr["Beitrag"][$i]["id"] = utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["link"] = $resturl."beitraege.php/st/".utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["Bezeichnung"] = utf8_encode($line["beitragsbezst"]);	
				$arr["Beitrag"][$i]["Betrag"] = utf8_encode($line["beitragst"]);	
				$i++;
			}
			$arr["count_all"] = $i;
			return $arr;
			break;
	}
}


function get_beitragdetails($abt,$id) {
	global $resturl;
    $arr = '';
	$i = 0;

	switch ($abt) {
		case "hv":
			$query = "SELECT * FROM beitraghv WHERE id=$id";
			$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
			while ($line = mysql_fetch_assoc($result)) {
				$arr["Beitrag"][$i]["id"] = utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["Bezeichnung"] = utf8_encode($line["beitragsbezhv"]);	
				$arr["Beitrag"][$i]["Betrag"] = utf8_encode($line["beitraghv"]);	
				$i++;
			}
			$arr["count_all"] = $i;
			return $arr;
			break;
		case "t":
			$query = "SELECT * FROM beitragt WHERE id=$id";
			$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
			while ($line = mysql_fetch_assoc($result)) {
				$arr["Beitrag"][$i]["id"] = utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["Bezeichnung"] = utf8_encode($line["beitragsbezt"]);	
				$arr["Beitrag"][$i]["Betrag"] = utf8_encode($line["beitragt"]);	
				$i++;
			}
			$arr["count_all"] = $i;
			return $arr;
			break;
		case "st":
			$query = "SELECT * FROM beitragst WHERE id=$id";
			$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
			while ($line = mysql_fetch_assoc($result)) {
				$arr["Beitrag"][$i]["id"] = utf8_encode($line["id"]);
				$arr["Beitrag"][$i]["Bezeichnung"] = utf8_encode($line["beitragsbezst"]);	
				$arr["Beitrag"][$i]["Betrag"] = utf8_encode($line["beitragst"]);	
				$i++;
			}
			$arr["count_all"] = $i;
			return $arr;
			break;
	}
}
?>