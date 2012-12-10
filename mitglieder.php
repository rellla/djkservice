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
if (isset($_GET['scol_name'])) {
	$params["scol_name"] = $_GET['scol_name'];
}
if (isset($_GET['sdir'])) {
	$params["sdir"] = $_GET['sdir'];
}
/*if (isset($_GET['search_sql'])) {
	$params["search_sql"] = stripslashes($_GET['search_sql']);
}*/
if (isset($_GET['search_sql'])) {
	$params["search_sql"] = $_GET['search_sql'];
}


// Andreas neu
if (isset($_GET['sort'])) {
	$params["sort"] = $_GET['sort'];
}


// Check for the path elements
$path = $_SERVER[PATH_INFO];
if ($path != null) {
    $path_params = spliti("/", $path);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') { // GET Request
	set_headers($type);
	if ($path_params[1] != null) {
		render_result(get_mitglied($path_params[1]),"mitglieder",$type); // Ressourcendarstellung
	} else {
		render_result(get_mitglieder($params),"mitglieder",$type); // Listenressource
	//echo $params["search_sql"];
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') { // PUT Request
	$input = file_get_contents("php://input");
	render_result(create_mitglied($input),null,$type); // create track entry and copy file 
}


mysql_close($database);
?>