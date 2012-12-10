<?php
/* **************************************************
/  REST Webservice fuer Vereins Mitglieder Datenbank
/  created by Andreas Baierl, 09.02.2010
/  
/
/  orte.php -	get Listenressource: GET ".../strassen" (alle Strassen)
/					get Ressourcendetails: GET ".../strassen/1" (Details von Strasse 1)
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
		if ($path_params[2] != null) {
			render_result(get_beitragdetails($path_params[1],$path_params[2]),"beitraege",$type); // Ressourcendarstellung
		} else {
			render_result(get_beitrag($path_params[1]),"beitraege",$type); // Ressourcendarstellung
		}
	} else {
		render_result(get_beitraege(),"beitraege",$type); // Listenressource
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