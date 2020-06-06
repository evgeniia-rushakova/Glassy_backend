<?php
include_once "../config/connect.php";
if(!isset($_SESSION))
	session_start();

function add_archive_to_cart($link)
{
	$sql = "SELECT * FROM archive WHERE user_email = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'s', $_SESSION['user']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$archive = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
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

function add_cart_to_archive($link)
{
	$sql = "SELECT COUNT(*) as cnt FROM archive WHERE user_email = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'s', $_SESSION['user']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$is_user_have_archive = mysqli_fetch_assoc($result);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
	if($is_user_have_archive['cnt'] == 0)
	{
		$sql = "INSERT INTO archive(product_id, user_email,quan) VALUES(?,?,?)";
		foreach ($_SESSION['order'] as $item)
		{
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt,'isi', $item['id'], $_SESSION['user'], $item['quan']);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			} else{
				echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
			}
		}
	}
}

function clean_archive($link)
{
	$sql = "DELETE FROM archive WHERE user_email = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'s', $_SESSION['user']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
}

function delete_item_from_archive($link)
{
	$sql ="DELETE FROM archive WHERE user_email = ? AND product_id = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'si', $_SESSION['user'], $_GET['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
}

function change_order_status($link)
{
	$sql = "UPDATE orders SET status = ? WHERE id =?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt,'si', $_POST['status'], $_POST['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
}

if(isset($_GET) && isset($_GET['act']))
{
	$link = connect_to_database();
	switch ($_GET['act'])
	{
		case "add":
			add_archive_to_cart($link);
			break;
		case "clean":
			clean_archive($link);
			break;
		case "archive":
			add_cart_to_archive($link);
			break;
		case "delitem":
			delete_item_from_archive($link);
			break;
		case "change_status":
			change_order_status($link);
	}
	$link = null;
	header("Location: ".$_SERVER['HTTP_REFERER']);
}