<?php
if(!is_array($_SESSION['cart'])) {
 $_SESSION['cart']=array();
}
$pid = $_REQUEST['pid']; 
if(!isset($_SESSION['cart'][$pid])) {
	$_SESSION['cart'][$pid]=0;
}
$_SESSION['cart'][$pid] += $_REQUEST['qty']; 


print "Added to Cart!!! <br>";

require "internal/cart.php";
?>