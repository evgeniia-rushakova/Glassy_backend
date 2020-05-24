<?php
include_once "config/connect.php";
include_once "server/generate_cart.php";
if (!isset($_SESSION))
	session_start();
if(!isset($_SESSION['user'])  && !$_SESSION['user'])
	$inout = file_get_contents("views/in-out_tpl.php");
else
	$inout = "<li class=\"user-navigation-item login-hover\"><a class=\"login-link\" href=\"server/logout.php\">Выход</a></li>";
$cart = generate_cart();

function generate_info_item($item_id)
{
	$template = file_get_contents("views/item_tpl.php");
	$pdo = connect_to_database();
	$sql = $pdo->prepare("SELECT * FROM products WHERE id = ?");
	$sql->execute(array($item_id));
	$info = $sql->fetch();
	$template = str_replace('{name}', $info['name'], $template);
	$template =  str_replace('{img}', ("views/img/" . $info['photo']), $template);
	$template =  str_replace('{price}', $info['price'], $template);
	$template =  str_replace('{fat}', $info['fat'], $template);
	$template =  str_replace('{alt}', ($info['name'] . " - образец фото"), $template);

	return $template;
}

$title = "Jslave Glassy";
$file = file_get_contents("views/catalog_item_tpl.php");
$header = file_get_contents("views/header_inner_tpl.php");
$footer = file_get_contents("views/footer_tpl.php");
$info = generate_info_item($_GET['id']);
$file = str_replace('{title}', $title, $file);
$file = str_replace('{header}', $header, $file);
$file = str_replace('{in-out}', $inout, $file);
$file = str_replace('{cart}', $cart, $file);
$file = str_replace('{content}', $info, $file);
$file = str_replace('{footer}', $footer, $file);
print($file);