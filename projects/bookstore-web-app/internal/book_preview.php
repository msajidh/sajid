

<?php 
// require "js/home.js";
// require "js/ajax.js";
$isbn = $_REQUEST["isbn"];
echo "<script>bookpreview_select_from_bookpreview($isbn);</script>";
// unset($_REQUEST["search"]);
?>
<div id="response">
<script src="js/ajax.js"></script>
<script src="js/home.js"></script>

<?php
require "internal/book_preview/index.html";
?>
</div> 
