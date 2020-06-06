<?php
include_once ("../config/connect.php");
if (!isset($_SESSION))
	session_start();

function delete_user()
{
	if($_SESSION['user'] == 'admin@admin' && isset($_GET['id']))
	{
		$link = connect_to_database();
		$sql = "DELETE FROM products WHERE id = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt,'i', $_GET['id']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			header("Location: ".$_SERVER['HTTP_REFERER']);
		} else{
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
	}
	else
		header("Location: ".$_SERVER['HTTP_REFERER']);

}
delete_user();