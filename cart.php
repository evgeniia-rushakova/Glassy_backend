<?php
include_once "server/generate_products.php";
include_once "server/generate_cart.php";
if (!isset($_SESSION))
	session_start();
if(isset($_SESSION['user']))
{
	$cart = generate_cart();
	$cart_inner = generate_inner_cart();
	$cart_archive = generate_archive();
	$orders = generate_orders();
	$title = "Cart";
	$inout = "<li class=\"user-navigation-item login-hover\"><a class=\"login-link\" href=\"server/logout.php\">Выход</a></li>";
	$file = file_get_contents("views/cart_tpl.php");
	$header = file_get_contents("views/header_inner_tpl.php");
	$footer = file_get_contents("views/footer_tpl.php");
	$products = generate_products(12);
	$file = str_replace('{title}', $title, $file);
	$file = str_replace('{header}', $header, $file);
	$file = str_replace('{in-out}', $inout, $file);
	$file = str_replace('{cart}', $cart, $file);
	$file = str_replace('{style}', "", $file);
	$file = str_replace('{cart-inner}',$cart_inner , $file);
	$file = str_replace('{cart-archive}',$cart_archive , $file);
	$file = str_replace('{style}', "color:white;", $file);
	$file = str_replace('{orders}', $orders, $file);
	$file = str_replace('{footer}', $footer, $file);
	print($file);
}
else
	echo "<script>alert('To rewiev cart, please register or login.'); location.href='../index.php';</script>";