<?php
/* **************************************************
/  REST Webservice fuer Vereins Mitglieder Datenbank
/  created by Andreas Baierl, 09.02.2010
/  
/
/  routen.php -		get Listenressource: GET ".../mitglieder" (alle Mitglieder)
/					get Ressourcendetails: GET ".../mitglied/1" (Details eines Mitglieds)
/					create Ressource: POST ".../mitglied"
/
/* *************************************************/

require_once "includes.php";

$database = init_database();
$params = null;

if (isset($_GET['type'])) {
	$type = $_GET['type'];
}
if (isset($_GET['start'])) {
	$params["start"] = $_GET['start'];
}
if (isset($_GET['amt'])) {
	$params["amt"] = $_GET['amt'];
}


// Check for the path elements
$path = $_SERVER[PATH_INFO];
if ($path != null) {
    $path_params = spliti("/", $path);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') { // GET Request
	set_headers($type);
	if ($path_params[1] != null) {
		render_result(get_jubilar($path_params[1]),"jubilare",$type); // Ressourcendarstellung
	} else {
		render_result(get_jubilare($params),"jubilare",$type); // Listenressource
	}
}

/* not used
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST Request
	$input = file_get_contents("php://input");
	render_result(create_route($input),null,$type); // create track entry and copy file 
}
*/

mysql_close($database);
?>