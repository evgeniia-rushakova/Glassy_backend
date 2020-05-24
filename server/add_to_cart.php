<?php
include_once "../config/connect.php";

if (!isset($_SESSION))
	session_start();

function		add_duo_to_cart()
{
	$ids = array();
	switch ($_GET['duo'])
	{
		case "rasp":
		{
			$ids['id1'] ="4";
			$ids['id2'] ="5";
			break;
		}
		case "lemon":
		{
			$ids['id1'] ="2";
			$ids['id2'] ="7";
			break;
		}
		case "straw":
		{
			$ids['id1'] ="8";
			$ids['id2'] ="6";
			break;
		}
	}
	foreach ($ids as $id)
	{
		$order = array();
		$order['id'] = $id;
		$order['quan'] = 0.5;
		$in_arr = 0;
		foreach ($_SESSION['order'] as $item)
		{
			if($item['id'] === $order['id'])
			{
				$in_arr = 1;
				break;
			}
		}
		if($in_arr === 0)
		{
			array_push($_SESSION['order'], $order);
		}
		else
		{
			$i = 0;
			while($_SESSION['order'][$i] && $_SESSION['order'][$i]['id'] != $order['id'])
				$i++;
			$_SESSION['order'][$i]['quan']+=$order['quan'];
		}
	}
}

function		add_product_to_cart()
{
	$order = array();
	if(!isset($_SESSION['order']))
		$_SESSION['order'] = array();
	if (isset($_GET['offer']))
	{
		$_SESSION['offer'] = $_GET['offer'];
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}
	else if(isset($_GET['duo']))
	{
		add_duo_to_cart();
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}
	else if(!isset($_GET['product_id']))
	{
		$arr = explode("=",$_SERVER['HTTP_REFERER']);
		$id = $arr[count($arr) - 1];
		$order['id'] = $id;
	}
	else if (isset($_GET['product_id']))
	{
		$order['id'] = $_GET['product_id'];
	}
			$order['quan'] = $_GET['quan'];
			$in_arr = 0;
			foreach ($_SESSION['order'] as $item)
			{
				if($item['id'] === $order['id'])
				{
					$in_arr = 1;
					break;
				}
			}
			if($in_arr === 0)
				array_push($_SESSION['order'], $order);
			else
			{
				$i = 0;
				while($_SESSION['order'][$i] && $_SESSION['order'][$i]['id'] != $order['id'])
					$i++;
				$_SESSION['order'][$i]['quan']+=$order['quan'];
			}

	header("Location: ".$_SERVER['HTTP_REFERER']);
}

add_product_to_cart();