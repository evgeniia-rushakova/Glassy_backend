<?php
include_once "../config/connect.php";

function register_user()
{
	$pdo = connect_to_database();
	$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$sql = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
	$sql->execute(array($_POST['email'], $pass));
	echo "<script>alert('Your registration is finished! Please, log-in.'); location.href='../index.php';</script>";
}
if(isset($_POST['email']) && isset($_POST['pass']))
	register_user();