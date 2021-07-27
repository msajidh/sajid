<!-- LOGIN FRONTEND Carlos H. Torres M -->
<!-- Modified date 28/05/2021 -->

<?php 
	
	if(isset($_SESSION['userlogin'])){
		header("Location: index.php");
	}
	include "internal/login/index.html"; 
	$_SESSION['username'] = "user";
?>
