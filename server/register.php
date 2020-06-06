<?php
include_once "../config/connect.php";

function register_user()
{
	$link = connect_to_database();
	$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$sql = "SELECT * FROM users WHERE email = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'s', $_POST['email']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
	if(count($users) == 0)
	{
		$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt,'ss',$_POST['email'], $pass);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		} else{
			echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
		}
		//$sql->execute(array($_POST['email'], $pass));
		echo "<script>alert('Your registration is finished! Please, log-in.'); location.href='../index.php';</script>";
	}
	else
		echo "<script>alert('This e-mail is already registered!Please, try another e-mail.'); location.href='../index.php';</script>";
}
if(isset($_POST['email']) && isset($_POST['pass']))
	register_user();