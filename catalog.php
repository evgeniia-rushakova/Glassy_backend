<?php
include_once "server/generate_products.php";
include_once "server/generate_cart.php";
if (!isset($_SESSION))
	session_start();
if(!isset($_SESSION['user']) && !$_SESSION['user'])
	$inout = file_get_contents("views/in-out_tpl.php");
else
	$inout = "<li class=\"user-navigation-item login-hover\"><a class=\"login-link\" href=\"server/logout.php\">Выход</a></li>";
$cart = generate_cart();

$title = "Jslave Glassy";

$file = file_get_contents("views/catalog_tpl.php");
$header = file_get_contents("views/header_inner_tpl.php");
$footer = file_get_contents("views/footer_tpl.php");
$products = generate_products(12, $_GET['type']);
$file = str_replace('{title}', $title, $file);
$file = str_replace('{header}', $header, $file);
$file = str_replace('{in-out}', $inout, $file);
$file = str_replace('{cart}', $cart, $file);
$file = str_replace('{products}', $products, $file);
$file = str_replace('{footer}', $footer, $file);
$admin_tpl = "					<li class=\"active catalog-navigation-item-inner current-page\">
						<a href=\"admin.php\">ADMIN</a>
						<ul class=\"catalog-navigation\">
							<li class=\"catalog-navigation-item-submenu\"><a href=\"admin.php\">Заказы</a></li>
							<li class=\"catalog-navigation-item-submenu\"><a href=\"add_item.php\">Добавить товар</a></li>
							<li class=\"catalog-navigation-item-submenu\"><a href=\"users.php\">Пользователи</a></li>
						</ul>
					</li>";
if($_SESSION['user'] == "admin@admin")
	$file = str_replace('{admin}',$admin_tpl , $file);
else
	$file = str_replace('{admin}', "", $file);
print($file);