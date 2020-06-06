<?php
include_once "../config/connect.php";
function login_user()
{
	$link = connect_to_database();

	$sql = "SELECT * FROM users WHERE email = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'s', $_POST['email']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$res = mysqli_fetch_assoc($result);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
	if (password_verify($_POST['password'], $res['password']))
	{
		if (!isset($_SESSION))
			session_start();
		$_SESSION['user'] = $res['email'];
		if($_SESSION['user'] == 'admin@admin')
			header("Location: ../admin.php");
		else
			header("Location: ../cart.php");
	}
	else
		echo "<script>alert('Wrong email or pass!'); location.href='../index.php';</script>";
}

if(isset($_POST['email']) && isset($_POST['password']))
	login_user();