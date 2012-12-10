<?php
$maparray = 	Array (
					"mitglieder" 	=> 	Array (
											"vname" => "Vorname",
											"nname" => "Nachname",
											"geburtstag" => "Geburtsdatum",
											"strname" => "Strasse",
											"hausnr" => "Hausnummer",
											"plz" => "PLZ",
											"ortname" => "Ort",
											"ortsteil" => "Ortsteil",
											"mid" => "ID",
											"alter_jahre" => "Alter",
											"geschlecht" => "Geschlecht",
											"fussball" => "Fussball",
											"tennis" => "Tennis",
											"stock" => "Stock",
											"gymnastik" => "Gymnastik",
											"statusbez" => "Status",
											"eintritt" => "Eintritt",
											"austritt" => "Austritt",
											"beitraghv" => "BeitragHV",
											"beitragsbezhv" => "BeitragHVbez",
											"beitragst" => "BeitragST",
											"beitragsbezst" => "BeitragSTbez",
											"beitragt" => "BeitragT",
											"beitragsbezt" => "BeitragTbez",
											"firma" => "Firma"
										) ,
					"strassen" 	=> 	Array (
											"id" => "ID",
											"strname" => "Strasse",
											"route" => "Route"
										)
				);

function map($table, $key) {
	global $maparray;
	if ($maparray[$table][$key]) { 
		$result = $maparray[$table][$key];
	} else {
		// $result = $key;
		$result = FALSE;
	}
	return $result;
}

?>