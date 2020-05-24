<?php

include_once 'database.php';

$db_dsn =  $DB_DSN;
$db_user = $DB_USER;
$db_name = $DB_NAME;
$db_pass = $DB_PASSWORD;

function create_users_table($pdo)
{
	$table = "CREATE TABLE IF NOT EXISTS users(
    		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY , 
			email VARCHAR(30) NOT NULL UNIQUE ,
			password VARCHAR(60))ENGINE=INNODB";
	$pdo->exec($table);
	$sql = $pdo->prepare("SELECT COUNT(*) FROM Users WHERE email = 'admin@admin'");
	$sql->execute();
	$admin_exists = $sql->fetchColumn();
	$password = password_hash("admin", PASSWORD_BCRYPT);
	if ($admin_exists == false)
	{
		$newstringintable = "INSERT INTO  Users (email, password) VALUES ('admin@admin', '$password')";
		$pdo->exec($newstringintable);
	}
}

function create_products_list($pdo)
{
    $table = "CREATE TABLE IF NOT EXISTS products(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    name TEXT NOT NULL ,
    type VARCHAR(30) NOT NULL ,
    fat INT(6) NOT NULL,
    price INT(6) NOT NULL,
    photo VARCHAR(50) NOT NULL UNIQUE ) ENGINE=INNODB";
    $pdo->exec($table);
	$contents = file_get_contents("products.json");
	$results = json_decode($contents, true);
	foreach ($results as $item)
    {
        $sql= $pdo->prepare("INSERT INTO products (name, type, fat, price, photo) VALUES (?,?,?,?,?)");
        $sql->execute(array($item["name"], $item["type"], $item["fat"], $item["price"], $item["photo"]));
    }
}

function create_archive($pdo)
{
	$table = "CREATE TABLE IF NOT EXISTS archive(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    product_id INT(6) UNSIGNED NOT NULL ,
    user_email VARCHAR(30) NOT NULL ,
    quan DECIMAL(10,3) NOT NULL ,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_email) REFERENCES users(email))  ENGINE=INNODB";
	$pdo->exec($table);
}

function create_orders($pdo)
{
	$table = "CREATE TABLE IF NOT EXISTS orders(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    user_email VARCHAR(30) NOT NULL ,
    order_number INT(6) UNSIGNED NOT NULL,
    status VARCHAR(30) NOT NULL 
) ENGINE=INNODB";
	$pdo->exec($table);
	$table_order_pos = "CREATE TABLE IF NOT EXISTS order_positions(
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
     order_id INT(6) UNSIGNED NOT NULL,
     product_id INT(6) UNSIGNED NOT NULL,
     quan DECIMAL(10,3) NOT NULL,
     offer VARCHAR(30),
     FOREIGN KEY (order_id) REFERENCES orders(id),
     FOREIGN KEY (product_id) REFERENCES products(id)
) ENGINE=INNODB";
	$pdo->exec($table_order_pos);
}

function create_database()
{
	global $db_dsn;
	global $db_user;
	global $db_name;
	global $db_pass;
	try
	{
		$pdo = new PDO($db_dsn, $db_user, $db_pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$pdo->query("CREATE DATABASE IF NOT EXISTS $db_name");
		$pdo->query("use $db_name");
	}
	catch(PDOException $e)
	{
		die("Database connection failed: " . $e->getMessage());
	}
	create_users_table($pdo);
	create_products_list($pdo);
	create_archive($pdo);
	create_orders($pdo);
	$pdo = null;
	return (true);
}
create_database();


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<link rel="preload" href="../css/style.css" as="style">
	<link rel="stylesheet" type="text/css" href="../css/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>Glassy - Setup</title>
</head>
<body>
<main>
	<div style="width:300px; margin: 150px auto;">
		<h2 class="profile__title" style="text-align: center;">Database create successfully</h2>
		<h2 class="profile__title" style="text-align: center;">Tables create successfully</h2>
		<form action="../index.php">
			<button class="sign-in-form__submit"autofocus="autofocus" tabindex="1" style="width: 300px; padding: 10px 20px;">go to Glassy-shop</button>
		</form>
	</div>
</main>
</body>
</html>

