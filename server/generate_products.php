<?php
include_once "config/connect.php";
function generate_products($how_much, $type)
{
	$link = connect_to_database();
	switch ($type)
	{
		case "all":
			$sql = "SELECT * FROM products";
			break;
		case "cream":
			$sql = "SELECT * FROM products WHERE type='cream'";
			break;
		case "choco":
			$sql = "SELECT * FROM products WHERE type='choco'";
			break;
		case "fruit":
			$sql = "SELECT * FROM products WHERE type='fruit'";
			break;
		case "mint":
			$sql = "SELECT * FROM products WHERE type='mint'";
			break;
	}
	if($result = mysqli_query($link, $sql)){
		mysqli_fetch_all($result,MYSQLI_ASSOC) ;
	//	mysqli_free_result($result);
		mysqli_close($link);
	}
	else
		echo "No records matching your query were found.";
	$products = "";
	$counter = 0;
	foreach ($result as $item)
	{
		if($counter < $how_much)
		{
			if($_SESSION['user'] == 'admin@admin')
				$delbutton = '<div class="button-wrapper"><a class="button button-visual" href="../server/delete_item.php?id={id}">Удалить из каталога</a></div>';
			else
				$delbutton = '';
			$temlate = file_get_contents("views/products-item_tpl.php");
			$temlate =  str_replace('{price}', $item['price'], $temlate);
			$temlate =  str_replace('{img}', ("views/img/" . $item['photo']), $temlate);
			$temlate =  str_replace('{alt}', ($item['name'] . " - образец фото"), $temlate);
			$temlate =  str_replace('{name}', $item['name'], $temlate);
			$temlate =  str_replace('{delbutton}', $delbutton, $temlate);
			$temlate =  str_replace('{id}', $item['id'], $temlate);
			$products.=$temlate;
			$counter++;
		}
	}
	return $products;
}