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
	$link = connect_to_database();
	$sql = "SELECT * FROM products WHERE id = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'i', $item_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$info = mysqli_fetch_assoc($result);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
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