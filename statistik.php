<?php
/* **************************************************
/  REST Webservice fuer Vereins Mitglieder Datenbank
/  created by Andreas Baierl, 09.02.2010
/  
/
/  statistik.php -	get Ressource: GET ".../statistik"
/					
/					
/
/* *************************************************/

require_once "includes.php";

$database = init_database();
$params = null;

if (isset($_GET['type'])) {
	$type = $_GET['type'];
}

// Check for the path elements
$path = $_SERVER[PATH_INFO];
if ($path != null) {
    $path_params = spliti("/", $path);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') { // GET Request
	set_headers($type);
	if ($path_params[1] != null) {
		render_result(get_statistik2($path_params[1]),"mitglieder",$type); // Ressourcendarstellung
	} else {
		render_result(get_statistik($params),"statistik",$type); // Listenressource
	}
}

mysql_close($database);
?>