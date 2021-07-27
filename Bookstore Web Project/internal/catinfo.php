<table class="table table-striped">
<tr>
<th>Name</th>
<th>Price</th>
</tr>
<?php
$cat = $_REQUEST['catid'];
$sql = "select * from product where Category=?";
///print "<pre>cat = $cat</pre>";
//print "<pre>sql = $sql</pre>";

if( $stmt = $mysqli->prepare($sql) ) {
	$stmt->bind_param("i", $cat);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		print "<tr><td><a href='?p=productinfo&pid=$row[ID]'>$row[Title]</a></td>".
			"<td>$row[Price] &euro;</td></tr>";
	}

}
?>

<!-- NEW -->
<?php
if(($_SESSION['is_logged_in'] == "True") && ($_SESSION["is_admin"] == 1))
{
echo "<h2>Add a Book</h2>
<form action=\"ajax/add_product.php\" method=\"post\">
	Title: <input type=\"text\" name=\"title\"><br>
	Description: <input type=\"text\" name=\"description\"><br>
	Price: <input type=\"number\" name=\"price\" step=\".01\"><br>
	<input type=\"hidden\" name=\"categoryid\" value=\"$cat\"><br>
	<input type=\"submit\">
</form>";
}
?>

</table>

