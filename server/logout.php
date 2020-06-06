<?php
if(!isset($_SESSION))
	session_start();
if(isset($_SESSION) && isset($_SESSION['user']))
{
	$_SESSION['user'] = NULL;
	if(isset($_SESSION['offer']))
		$_SESSION['offer'] = NULL;
	if(isset($_SESSION['order']))
		$_SESSION['order'] = NULL;
}
if ($_SERVER['HTTP_REFERER'] == "cart.php" || $_SERVER['HTTP_REFERER'] == "admin.php")
	header("Location: index.php");
else
	header("Location: ".$_SERVER['HTTP_REFERER']);