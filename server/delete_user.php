<?php
include_once ("../config/connect.php");
if (!isset($_SESSION))
	session_start();

function delete_user()
{
	if($_SESSION['user'] == 'admin@admin' && isset($_GET['id']))
	{
		$link = connect_to_database();
		$sql = "DELETE FROM users WHERE id = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt,'i', $_GET['id']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			echo "<script>alert('User deleted!'); location.href='../users.php';</script>";
		} else{
			echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
		}
	}
	else
		echo "<script>alert('Error with deleting user'); location.href='../users.php';</script>";

}
delete_user();