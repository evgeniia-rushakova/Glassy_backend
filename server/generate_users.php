<?php
include_once "config/connect.php";
function generate_users()
{
	$link = connect_to_database();

	$sql = "SELECT * FROM users";

	if($result = mysqli_query($link, $sql)){
		$res = mysqli_fetch_all($result,MYSQLI_ASSOC) ;
		mysqli_free_result($result);
	}
	else
		echo "No records matching your query were found.";
	$users = "";

	$counter = 0;
	foreach ($res as $item)
	{
		if($item['email'] != 'admin@admin')
		{
			$sql = "SELECT * FROM orders WHERE user_email = ?";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt,'s', $item['email']);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$orders_count = mysqli_fetch_all($result, MYSQLI_ASSOC);
				mysqli_stmt_close($stmt);
			} else{
				echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
			}
			if (count($orders_count) == 0)
			{
				$ord_of_user= "<p>Нет заказов</p>";
			}
			else
			{
				$orders_tpl = "<p>Заказ № <b>{num}</b>.Статус: <b>{status}</b>";
				$orders = [];
				foreach ($orders_count as $it)
				{
					if($it['user_email'] == $item['email'])
						array_push($orders, $it);
				}
				$ord_of_user = "";
				foreach ($orders as $ord)
				{
					$tpl = $orders_tpl;
					$tpl=  str_replace('{num}', $ord['order_number'], $tpl);
					$tpl=  str_replace('{status}', $ord['status'], $tpl);
					$ord_of_user.=$tpl;
				}
			}

			$template = file_get_contents("views/user_tpl.php");
			$template =  str_replace('{id}', $item['id'], $template);
			$template =  str_replace('{e-mail}', $item['email'], $template);


			$template =  str_replace('{orders}', $ord_of_user, $template);
			$users.=$template;
		}
			$counter++;
	}
	mysqli_close($link);
	return $users;
}