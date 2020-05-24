<?php
include_once "../config/connect.php";
function login_user()
{
	$pdo = connect_to_database();
	$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$sql = $pdo->prepare("SELECT * FROM users WHERE email = ?");
	$sql->execute(array($_POST['email']));
	$res = $sql->fetch();
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