<?php
include_once "../config/connect.php";
if(!isset($_SESSION))
	session_start();

function add_archive_to_cart($pdo)
{
	$sql = $pdo->prepare("SELECT * FROM archive WHERE user_email = ?");
	$sql->execute(array($_SESSION['user']));
	$archive = $sql->fetchAll();
	foreach ($archive as $item)
	{
		$i = 1;
		if($_SESSION['order'])
		{
			$counter = count($_SESSION['order']);
			foreach ($_SESSION['order'] as $order_item)
			{
				if($order_item['id'] == $item['product_id'])
				{
					$order_item['quan']+=$item['quan'];
					$_SESSION['order'][$i - 1]['quan']+= $item['quan'];
					$i =0;
					break;
				}
				$i++;
			}
		}
		else
		{
			$i = 1;
			$counter = 0;
		}



		if ($i == $counter +1) {
			$new_row = [];
			$new_row['id'] = $item['product_id'];
			$new_row['quan'] = $item['quan'];
			if($_SESSION['order'] == null)
				$_SESSION['order'] = [];
			array_push($_SESSION['order'], $new_row);
		}
	}
}

function add_cart_to_archive($pdo)
{
	$sql = $pdo->prepare("SELECT COUNT(*) FROM archive WHERE user_email = ?");
	$sql->execute(array($_SESSION['user']));
	$is_user_have_archive = $sql->fetch()['COUNT(*)'];
	if($is_user_have_archive == 0)
	{
		foreach ($_SESSION['order'] as $item)
		{
			$sql = $pdo->prepare("INSERT INTO archive(product_id, user_email,quan) VALUES(?,?,?)");
			$sql->execute(array($item['id'], $_SESSION['user'], $item['quan']));
		}
	}
}

function clean_archive($pdo)
{
	$sql = $pdo->prepare("DELETE FROM archive WHERE user_email = ?");
	$sql->execute(array($_SESSION['user']));
}

function delete_item_from_archive($pdo)
{
	$sql = $pdo->prepare("DELETE FROM archive WHERE user_email = ? AND product_id = ?");
	$sql->execute(array($_SESSION['user'], $_GET['id']));
}

function change_order_status($pdo)
{
	$sql = $pdo->prepare("UPDATE orders SET status = ? WHERE id =?");
	$sql->execute(array($_POST['status'], $_POST['id']));
}

if(isset($_GET) && isset($_GET['act']))
{
	$pdo = connect_to_database();
	switch ($_GET['act'])
	{
		case "add":
			add_archive_to_cart($pdo);
			break;
		case "clean":
			clean_archive($pdo);
			break;
		case "archive":
			add_cart_to_archive($pdo);
			break;
		case "delitem":
			delete_item_from_archive($pdo);
			break;
		case "change_status":
			change_order_status($pdo);
	}
	$pdo = null;
	header("Location: ".$_SERVER['HTTP_REFERER']);
}