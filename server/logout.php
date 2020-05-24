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

header("Location: ".$_SERVER['HTTP_REFERER']);