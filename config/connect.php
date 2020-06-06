<?php
include_once "database.php";

$db_dsn =  $DB_DSN;
$db_user = $DB_USER;
$db_name = $DB_NAME;
$db_pass = $DB_PASSWORD;

function connect_to_database()
{
	global $db_dsn;
	global $db_user;
	global $db_pass;
	global $db_name;
	$link = mysqli_connect($db_dsn, $db_user, $db_pass, $db_name);
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	return ($link);
}
