<?php
include_once "config/connect.php";
if (!isset($_SESSION))
	session_start();

function generate_item_in_cart()
{
	$link = connect_to_database();
	$sql = "SELECT * FROM products";
	if($result = mysqli_query($link, $sql)){
		$products = mysqli_fetch_all($result,MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($link);
	}
	else
		echo "No records matching your query were found.";
	$items = "";
	$info = array();
	$amount = 0;
	$kilos = 0;
	if(isset($_SESSION['order']))
	{
		foreach ($_SESSION['order'] as $item)
		{
			$template = file_get_contents("views/item_in_cart.php");
			$i = 0;
			while ($i < count($products) && $item['id'] != $products[$i]['id'])
				$i++;
			if ($i == count($products))
				break;
			$template = str_replace('{img}',"views/img/" . $products[$i]['photo'], $template);
			$template = str_replace('{name}', $products[$i]['name'], $template);
			$template = str_replace('{id}', $products[$i]['id'], $template);
			$template = str_replace('{how_much}', $item['quan'], $template);
			$template = str_replace('{dellink}', "delete_from_cart.php?", $template);
			$template = str_replace('{price}', $products[$i]['price'], $template);
			$price=($item['quan'] * $products[$i]['price']);
			$amount+=$price;
			$kilos+= $item['quan'];
			$template = str_replace('{amount}', $price, $template);
			$items.=$template;
		}
	}
	if(isset($_SESSION['offer']))
	{
		$offer_template = "<tr class=\"client-choise-row\">
<td class=\"delete\"><a href='server/delete_from_cart.php?id=offer'><img src=\"../views/img/delete.svg\" alt=\"удалить из заказа\" width=\"11\" height=\"11\"></a></td>
<td></td>
    <td class=\"icecream-link\">
        <p style=\"color: {color};\">Акция! {act} в подарок - {result}</p>
    </td>
</tr>";
		if($_SESSION['offer'] === "raspberry")
		{
			$color = "#ff2554";
			$act = "Малинка";
		}
		else if($_SESSION['offer'] === "chocolate")
		{
			$color = "#A6370B";
			$act = "Шоколадки";
		}
		$offer_template = str_replace('{color}', $color, $offer_template);
		$offer_template = str_replace('{act}', $act, $offer_template);
		$sum = $kilos >= 2 ? "добавлено" : "нужно больше мороженого!";
		$offer_template = str_replace('{result}', $sum, $offer_template);
		$info['offer'] = $offer_template;
	}
	else
		$info['offer'] = '';
	$info['items'] = $items;
	$info['amount'] = $amount;
	return $info;
}

function generate_cart()
{
	$empty = "<li class=\"user-navigation-item bucket-hover\">
	<a class=\"bucket-link\" href=\"Bucket.html\">Пусто</a>
</li>";
	if(!isset($_SESSION['offer']) && !isset($_SESSION['order']) || (isset($_SESSION['order']) && !count($_SESSION['order'])))
		return $empty;
	if(isset($_SESSION['user']) && $_SESSION['user'] == "admin@admin")
		return $empty;
	$info = generate_item_in_cart();
	$full = file_get_contents("views/bucket_full.php");
	if(isset($_SESSION['order']))
		$full = str_replace('{total}', count($_SESSION['order']), $full);
	$full = str_replace('{items}',$info['items'], $full);
	$full = str_replace('{offer}',$info['offer'], $full);
	$full = str_replace('{price}',$info['amount'], $full);

	return($full);
}

function generate_inner_cart()
{
	$info = generate_item_in_cart();
	$full = "<table class=\"client-choise client-choise-cart\">
			{items}
			{offer}
			<tr class=\"client-choise-row-amount\">
				<td colspan=\"5\" style='color: white;'>Итого: {price} руб.</td>
			</tr>
		</table>";
	$full = str_replace('{items}',$info['items'], $full);
	$full = str_replace('{offer}',$info['offer'], $full);
	$full = str_replace('{price}',$info['amount'], $full);
	return($full);
}

function generate_archive()
{
	$archive_template = "		<h3 class=\"cart-titleh3\">В архиве: </h3>
		<table class=\"client-choise client-choise-cart\">
		{cart-archive-inner}
		<tr class=\"client-choise-row-amount\">
                      <td colspan=\"5\" style='color: white;'>Итого: {total} руб.</td>
                    </tr>
		</table>
		<div class=\"buttons\">
		<a href=\"../server/archive.php?act=add\" class=\"button button-chocolate\">Добавить в текущий заказ</a>
		<a href=\"../server/archive.php?act=clean\" class=\"button button-chocolate\">Очистить архив</a></div>";
	$link = connect_to_database();
	$sql = "SELECT * FROM archive INNER JOIN products ON archive.product_id=products.id WHERE user_email = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'s', $_SESSION['user']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$is_user_have_archive = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
	if(count($is_user_have_archive) != 0)
	{
		$items = "";
		$total = 0;
		foreach ($is_user_have_archive as $item)
		{
			$template = file_get_contents("views/item_in_cart.php");
			$template = str_replace('{id}',$item['id'], $template);
			$template = str_replace('{img}',"views/img/" . $item['photo'], $template);
			$template = str_replace('{name}',$item['name'], $template);
			$template = str_replace('{how_much}',$item['quan'], $template);
			$template = str_replace('{dellink}', "archive.php?act=delitem&", $template);
			$template = str_replace('{price}',$item['price'], $template);
			$price = $item['price'] * $item['quan'];
			$total+=$price;
			$template = str_replace('{amount}',$price, $template);
			$items.=$template;
		}
		$archive_template = str_replace('{cart-archive-inner}',$items, $archive_template);
		$archive_template = str_replace('{total}',$total, $archive_template);
		return($archive_template);
	}
	return("");
}

function generate_orders()
{
	$link = connect_to_database();
	$sql = "SELECT * FROM orders WHERE user_email = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'s', $_SESSION['user']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$orders_count = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
	if (count($orders_count) == 0)
		return ("<p>У вас еще не быо заказов</p>");
	else
	{
		$result = "";
		foreach ($orders_count as $order)
		{
			$template = "<div style='margin: 10px;border: 1px dashed white;border-radius: 10px; max-width: 80%'><p style='margin-left: 10px;'>Номер заказа: <b>{num}</b></p><p style='margin-left: 10px;'>Статус заказа: <b>{status}</b></p></div>";
			$template = str_replace('{num}',$order['order_number'], $template);
			$template = str_replace('{status}',$order['status'], $template);
			$result.=$template;
		}
		return $result;
	}
}

function generate_orders_to_admin()
{
	$link = connect_to_database();
	$sql = "SELECT * FROM orders";
	if($result = mysqli_query($link, $sql)){
		$orders = mysqli_fetch_all($result, MYSQLI_ASSOC) ;
		mysqli_free_result($result);
	}
	else
		echo "No records matching your query were found.";

	$sql = "SELECT * FROM orders INNER JOIN order_positions ON orders.id=order_positions.order_id INNER JOIN products ON order_positions.product_id=products.id";
	if($res = mysqli_query($link, $sql)){
		$result = mysqli_fetch_all($res, MYSQLI_ASSOC) ;
		mysqli_free_result($res);
	}
	else
		echo "No records matching your query were found.";
	$return = "";
	foreach ($orders as $order)
	{
		$template_order = file_get_contents("views/order_in_admis_page_tpl.php");
		$id = $order['id'];

		$i = 0;
		$total = 0;
		$rows = "";

		while ($i < count($result) && isset($result[$i]) && $result[$i]['order_id'] != $id)
			$i++;
		while (isset($result[$i]) && $result[$i]['order_id'] == $id)
		{
			$arr = $result[$i];
			$status = $arr['status'];
			$number = $arr['order_number'];
			$email = $arr['user_email'];
			$offer = $arr['offer'];
			$row = file_get_contents("views/row_in_order_tpl.php");
			$row = str_replace('{pos}',$arr['name'], $row);
			$row = str_replace('{quan}',$arr['quan'], $row);
			$row = str_replace('{price}',$arr['price'], $row);
			$amount = $arr['quan'] * $arr['price'];
			$total+=$amount;
			$row = str_replace('{amount}',$amount, $row);
			$rows.=$row;
			$i++;
		}
		$template_order = str_replace('{rows}',$rows, $template_order);
		$template_order = str_replace('{total}',$total, $template_order);
		$template_order = str_replace('{id}',$id, $template_order);
		$template_order = str_replace('{number}',$number, $template_order);
		$template_order = str_replace('{offer}',$offer, $template_order);
		$template_order = str_replace('{status}',$status, $template_order);
		$template_order = str_replace('{email}',$email, $template_order);
		$return.=$template_order;
	}
	return $return;
}