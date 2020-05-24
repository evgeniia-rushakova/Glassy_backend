<?php
include_once ("../config/connect.php");
if (!isset($_SESSION))
	session_start();
function	delete_from_cart()
{
	if($_GET['id'] === 'offer')
		unset($_SESSION['offer']);
	else
	{
		$i =0;
		while($_SESSION['order'][$i] && $_SESSION['order'][$i]['id'] != $_GET['id'])
			$i++;
		array_splice($_SESSION['order'], $i, 1);
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

function create_order()
{
	$number = random_int(100, 999);
	$pdo = connect_to_database();
	$sql = $pdo->prepare("INSERT INTO orders(user_email, order_number, status) values(?,?,?)");
	$sql->execute(array($_SESSION['user'], $number, "Принят в обработку"));
	$id = $pdo->lastInsertId();
	if(isset($_SESSION['offer']))
		$offer = $_SESSION['offer'];
	else
		$offer = NULL;
	foreach ($_SESSION['order'] as $item)
	{
		$sqlin = $pdo->prepare("INSERT INTO order_positions(order_id, product_id, quan, offer) VALUES (?,?,?,?)");
		$sqlin->execute(array($id, $item['id'], $item['quan'], $offer));
	}

	return $number;
}

if(isset($_GET['id']))
	delete_from_cart();
else if(isset($_GET['act']) && ($_GET['act'] == 'delete' || $_GET['act'] == 'buy'))
{
	$need_alert = false;
	if ($_GET['act'] == 'buy')
	{

		$need_alert =create_order();
	}
	if(isset($_SESSION['order']))
		array_splice($_SESSION['order'], 0, count($_SESSION['order']));
	if(isset($_SESSION['offer']))
	{
		$i =0;
		$keys = array_keys($_SESSION);
		while($keys[$i] && $keys[$i] != 'offer')
			$i++;
		array_splice($_SESSION, $i, 1);
		//array_splice($_SESSION['offer'],0, 1);
	}

	if($need_alert == false)
		header("Location: ".$_SERVER['HTTP_REFERER']);
	else
		echo "<script>alert('Your order was created!Your number is " . $need_alert ."'); location.href='../cart.php';</script>";
}




