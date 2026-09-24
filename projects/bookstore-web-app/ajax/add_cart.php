<?php
session_start();
if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
 $_SESSION['cart']=array();
}
$pid = $_REQUEST['pid']; 
if(!isset($_SESSION['cart'][$pid])) {
	$_SESSION['cart'][$pid]=0;
}
$_SESSION['cart'][$pid] += $_REQUEST['qty']; 


print "Product added to your cart <br>You have  " . $_SESSION['cart'][$pid] . " products in your cart";
?>
