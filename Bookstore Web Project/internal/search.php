<?php 
$query = "'a'";
if(isset($_REQUEST["query"]))
{
    $query = $_REQUEST["query"];
}
$orderBy = "null";
if(isset($_REQUEST["orderBy"]))
{
    $orderBy = $_REQUEST["orderBy"];
}
$limit = 15;
$offset = 0;
if(isset($_REQUEST["limit"]))
{
    $limit = $_REQUEST["limit"];
}
if(isset($_REQUEST["offset"]))
{
    $offset = $_REQUEST["offset"];
}

echo "<script>search_select_from_bookpreview($query, $orderBy, $limit, $offset);</script>";
// unset($_REQUEST["search"]);
?>
<div id="response">
<?php
require_once "internal/books.php";
?>
</div> 