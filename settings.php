<?php

/* Database Settings */
$dbhost = "localhost";  // Database Host
$dbuser = "";  // Database User
$dbpasswd = "";  // Database Password
$dbname = "";  // Database Name

/* Rendering Settings */
$type = "json"; // How should the request be rendered ? (json|xml|html|raw)

/* Query Settings */
$limit = 1000; // Limit for Track- and Album - Queries

/* Settings for file access */
$ip = $_SERVER['HTTP_HOST'];
$resturl = "http://".$ip."/djkservice/";
?>
