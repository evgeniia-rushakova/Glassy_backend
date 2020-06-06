<?php
include_once "database.php";
echo "INFO:\n";
$link = mysqli_connect($DB_DSN, $DB_USER, $DB_PASSWORD);
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
echo "Connect Successfully. Host info: " . mysqli_get_host_info($link) . "\n";
$sql = "CREATE DATABASE IF NOT EXISTS " . $DB_NAME;
if(mysqli_query($link, $sql)){
	echo "\nDatabase $DB_NAME created successfully\n";
} else{
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
$sql = "USE $DB_NAME";
if(mysqli_query($link, $sql)){
	echo "\nConnection with $DB_NAME created successfully\n";
} else{
	echo "ERROR: Could not use this databasee $sql. " . mysqli_error($link);
}
$table_users = "CREATE TABLE IF NOT EXISTS users(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY , 
			email VARCHAR(30) NOT NULL UNIQUE ,
			password VARCHAR(60))ENGINE=INNODB";
if(mysqli_query($link, $table_users)){
	echo "\ntable users created successfully\n";
} else {
	echo "ERROR(creating table users): Could not able to execute $sql. " . mysqli_error($link);
}
$password = password_hash("admin", PASSWORD_BCRYPT);
$admin = "INSERT IGNORE INTO  Users (email, password) VALUES ('admin@admin', '$password')";
if(mysqli_query($link, $admin)){
	echo "\nadmin user created successfully\n";
} else {
	echo "ERROR(creating admin): Could not able to execute $sql. " . mysqli_error($link);
}
$products = "CREATE TABLE IF NOT EXISTS products(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    name TEXT NOT NULL ,
    type VARCHAR(30) NOT NULL ,
    fat INT(6) NOT NULL,
    price INT(6) NOT NULL,
    photo VARCHAR(50) NOT NULL UNIQUE ) ENGINE=INNODB";
if(mysqli_query($link, $products)){
	echo "\ntable products created successfully\n";
} else {
	echo "ERROR(creating table products): Could not able to execute $sql. " . mysqli_error($link);
}
$archive_sql =  "CREATE TABLE IF NOT EXISTS archive(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    product_id INT(6) UNSIGNED NOT NULL ,
    user_email VARCHAR(30) NOT NULL ,
    quan DECIMAL(10,3) NOT NULL ,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_email) REFERENCES users(email))  ENGINE=INNODB";
if(mysqli_query($link, $archive_sql)){
	echo "\ntable archive created successfully\n";
} else {
	echo "ERROR(creating table archive): Could not able to execute $sql. " . mysqli_error($link);
}
$orders = "CREATE TABLE IF NOT EXISTS orders(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    user_email VARCHAR(30) NOT NULL ,
    order_number INT(6) UNSIGNED NOT NULL,
    status VARCHAR(30) NOT NULL 
) ENGINE=INNODB";
$order_pos = $table_order_pos = "CREATE TABLE IF NOT EXISTS order_positions(
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
     order_id INT(6) UNSIGNED NOT NULL,
     product_id INT(6) UNSIGNED NOT NULL,
     quan DECIMAL(10,3) NOT NULL,
     offer VARCHAR(30),
     FOREIGN KEY (order_id) REFERENCES orders(id),
     FOREIGN KEY (product_id) REFERENCES products(id)
) ENGINE=INNODB";
if(mysqli_query($link, $orders)){
	echo "\ntable orders created successfully\n";
} else {
	echo "ERROR(creating table orders): Could not able to execute $sql. " . mysqli_error($link);
}
if(mysqli_query($link, $order_pos)){
	echo "\ntable order_positions created successfully\n";
} else {
	echo "ERROR(creating table order_positions): Could not able to execute $sql. " . mysqli_error($link);
}
$contents = file_get_contents("products.json");
$results = json_decode($contents, true);
$prod_sql = "INSERT INTO products (name, type, fat, price, photo) VALUES (?,?,?,?,?)";
echo "\nPRODUCTS IN SHOP:\n";
foreach ($results as $item)
{
	if($stmt = mysqli_prepare($link, $prod_sql)){
		mysqli_stmt_bind_param($stmt,'ssiis', $name, $type, $fat, $price, $photo);
		$name = $item["name"];
		$type = $item["type"];
		$fat = $item["fat"];
		$price = $item["price"];
		$photo = $item["photo"];
		mysqli_stmt_execute($stmt);
		echo $item['name'] . " was added to shop\n";
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
	}
	mysqli_stmt_close($stmt);
}
mysqli_close($link);
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
        <form action="../index.php">
            <button class="sign-in-form__submit"autofocus="autofocus" tabindex="1" style="width: 300px; padding: 10px 20px;">go to Glassy-shop</button>
        </form>
    </div>
</main>
</body>
</html>