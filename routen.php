<?php
/* **************************************************
/  REST Webservice fuer Vereins Mitglieder Datenbank
/  created by Andreas Baierl, 09.02.2010
/  
/
/  routen.php -		get Listenressource: GET ".../routen" (alle Routen)
/					get Ressourcendetails: GET ".../routen/1" (alle Strassen einer Route)
/					create Ressource: POST ".../routen"
/
/* *************************************************/

require_once "includes.php";

$database = init_database();
$param = null;

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
		render_result(get_route($path_params[1]),"route",$type); // Ressourcendarstellung
	} else {
		render_result(get_routen(),"routen",$type); // Listenressource
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