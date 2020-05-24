<?php
include_once "server/generate_products.php";
include_once "server/generate_cart.php";
if (!isset($_SESSION))
	session_start();
if(isset($_SESSION['user'])&& $_SESSION['user'] == "admin@admin")
{
	if(!isset($_SESSION['user']) && !$_SESSION['user'])
		$inout = file_get_contents("views/in-out_tpl.php");
	else
		$inout = "<li class=\"user-navigation-item login-hover\"><a class=\"login-link\" href=\"server/logout.php\">Выход</a></li>";
	$cart = generate_cart();
	$title = "Admins Page";
	$content = generate_orders_to_admin();
	$file = file_get_contents("views/admin_tpl.php");
	$header = file_get_contents("views/header_inner_tpl.php");
	$footer = file_get_contents("views/footer_tpl.php");
	$file = str_replace('{title}', $title, $file);
	$file = str_replace('{header}', $header, $file);
	$file = str_replace('{in-out}', $inout, $file);
	$file = str_replace('{cart}', $cart, $file);
	$file = str_replace('{content}', $content, $file);
	$file = str_replace('{footer}', $footer, $file);
	print($file);
}
else
	echo "<script>alert('You are not admin!'); location.href='../index.php';</script>";
