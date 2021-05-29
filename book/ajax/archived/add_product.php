<?php
require "../internal/dbconnect.php";
session_start();
$sql = "INSERT INTO product (Title, Description, Price,Category) VALUES (?,?,?,?)";

echo $sql;

$price = number_format($_REQUEST["price"], 2);
$catid = number_format($_REQUEST["categoryid"]);
$title = $_REQUEST["title"];
$desc = $_REQUEST["description"];

$stmt = $mysqli->prepare($sql);

if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

$stmt->bind_param("ssdi", $title, $desc, $price, $catid);

$stmt->execute();

$product_id = $mysqli->insert_id;

echo "\nNew product submitted :  product_id=$product_id<br>";

// $result = $stmt->get_result();

// echo $result;

// $row = $result->fetch_assoc();

// echo $row;

?>