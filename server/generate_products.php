<?php
include_once "config/connect.php";
function generate_products($how_much, $type)
{
	$pdo = connect_to_database();
	switch ($type)
	{
		case "all":
			$sql = $pdo->prepare("SELECT * FROM products");
			break;
		case "cream":
			$sql = $pdo->prepare("SELECT * FROM products WHERE type='cream'");
			break;
		case "choco":
			$sql = $pdo->prepare("SELECT * FROM products WHERE type='choco'");
			break;
		case "fruit":
			$sql = $pdo->prepare("SELECT * FROM products WHERE type='fruit'");
			break;
		case "mint":
			$sql = $pdo->prepare("SELECT * FROM products WHERE type='mint'");
			break;
	}

	$sql->execute();
	$result = $sql->fetchAll();
	$products = "";
	$counter = 0;
	foreach ($result as $item)
	{
		if($counter < $how_much)
		{
			$temlate = file_get_contents("views/products-item_tpl.php");
			$temlate =  str_replace('{price}', $item['price'], $temlate);
			$temlate =  str_replace('{img}', ("views/img/" . $item['photo']), $temlate);
			$temlate =  str_replace('{alt}', ($item['name'] . " - образец фото"), $temlate);
			$temlate =  str_replace('{name}', $item['name'], $temlate);
			$temlate =  str_replace('{id}', $item['id'], $temlate);
			$products.=$temlate;
			$counter++;
		}
	}
	return $products;
}