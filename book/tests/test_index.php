<!doctype html>
<html lang="en">
<?php
session_start();

require_once "../internal/dbconnect.php";
include "../debug/chromephp-master/ChromePhp.php";
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Bookstore - Testing</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/dashboard.css" rel="stylesheet">

    <!-- Add ajax files -->
    <script src="ajax/ajax.js"></script>
    <script>
// =====================================================
// JS functions for inserting a row to the database
// ===================================================== 
    function add_to_cart(customerid, bookid)
    {
        var quantity_id = bookid.substring(0,14) + "_quantity_insert";           
        var quantity = parseInt($("#" + quantity_id).val());
                                
        var data = {"customerid": customerid, 
                    "bookid": bookid,
                    "quantity": quantity
                    };
        // Calls below function in the ajax/ajax.js file
        add_cart(data); 
    }


    function add_to_category()
    {
        var category_id = "category_insert";           
        var category = $("#" + category_id).val();
                                
        var data = {"name": category};

        // Calls below function in the ajax/ajax.js file
        add_category(data); 
    }

// ======================================================
// JS functions for updating a row in the databse 
// =======================================================

    function update_in_cart(customerid, bookid)
    {
        var quantity_id = bookid.substring(0,14) + "_quantity_update";           
        var quantity = parseInt($("#" + quantity_id).val());
                                
        var data = {"customerid": customerid, 
                    "bookid": bookid,
                    "quantity": quantity
                    };
        // Calls below function in the ajax/ajax.js file 
        update_cart(data); 
    }

    function update_in_category(id)
    {
        var name = $("#category_name_update").val();
                                
        var data = {"id": parseInt(id), 
                    "name": name
                    };
        // Calls below function in the ajax/ajax.js file 
        update_category(data); 
    }

// ======================================================
// JS functions for selecting rows from the database 
// =======================================================
    function select_from_cart(customerid)
        {                        
            var data = {"customerid": customerid};

            // Calls below function in the ajax/ajax.js file 
            show_cart(data); 
        }

    function select_from_category(id)
        {                        
            var data = {"id": parseInt(id)};

            // Calls below function in the ajax/ajax.js file 
            show_category(data); 
        }

    </script>
  </head>
<body>
    <h1>Testing - Insert</h1>

    <!-- ==== Testing component inserts ==== 
    ======================================== --> 
    <?php
    print "<h1>Insert To Database Tables</h1>";
    echo "<h2>Table: Cart</h2>";
    
    // uncomment below only when applicable - for admin panel testing
        //   <h3>Via Form</h3>
        //   <form action=\"ajax/add_product.php\" method=\"post\">
        //         Title: <input type=\"text\" name=\"title\"><br>
        //         Description: <input type=\"text\" name=\"description\"><br>
        //         Price: <input type=\"number\" name=\"price\" step=\".01\"><br>
        //         <input type=\"hidden\" name=\"categoryid\" value=\"$cat\"><br>
        //         <input type=\"submit\">
        //   </form>

    $bookid = "1234567891012";
    $bookid_json = "'1234567891012'";
    $customerid = "1";
    
    print "<h3>Via Button with pre-defined values</h3>
            <p>Existing bookid = $bookid</p>
            <p>Existing customerid = $customerid</p>
            <form>
        	    Quantity: <input type=\"number\" name=\"quantity\" id=\"${bookid}_quantity_insert\" value=\"1\"><br>
            </form>
            <button onclick=\"add_to_cart($customerid , $bookid_json )\">Submit</button>";
    
    echo "<p id=\"add_to_cart_response\"></p>";

    echo "<h2>Table: Category</h2>";
    
    print "<form>
        	    New Category Name: <input type=\"text\" name=\"category_name\" id=\"category_insert\"><br>
            </form>
            <button onclick=\"add_to_category()\">Submit</button>";
    
    echo "<p id=\"add_to_category_response\"></p>";
   ?>

    <h1>Testing - Update</h1>

    <!-- ==== Testing components - update ==== 
    ======================================== --> 
    <?php
    print "<h1>Update Database Tables</h1>";
    echo "<h2>Table: Cart</h2>";

    $bookid = "1234567891012";
    $bookid_json = "'1234567891012'";
    $customerid = "1";

    print "<h3>Via Button with pre-defined values</h3>
            <p>Existing bookid = $bookid</p>
            <p>Existing customerid = $customerid</p>
            <form>
                New Quantity: <input type=\"number\" name=\"quantity\" id=\"${bookid}_quantity_update\" value=\"1\"><br>
            </form>
            <button onclick=\"update_in_cart($customerid, $bookid_json )\">Submit</button>";

    echo "<p id=\"update_in_cart_response\"></p>";


    echo "<h2>Table: Category</h2>";
    
    $categoryid = 1;

    print "<h3>Via Button with pre-defined values</h3>
            <p>Existing id = $categoryid</p>
            <form>
                New Name: <input type=\"text\" name=\"name\" id=\"category_name_update\"><br>
            </form>
            <button onclick=\"update_in_category($categoryid)\">Submit</button>";

    echo "<p id=\"update_in_category_response\"></p>";

?>


    <h1>Testing - Select</h1>

    <!-- ==== Testing components - select ==== 
    ======================================== --> 
    <?php
    print "<h1>Select Database Tables</h1>";
    echo "<h2>Table: Cart</h2>";

    $customerid = "1";
 
    print "<h3>Via Button with pre-defined values</h3>
            <p>Existing customerid = $customerid</p>
            <button onclick=\"select_from_cart($customerid)\">Submit</button>";

    echo "<p id=\"select_from_cart_response\"></p>";

   
    echo "<h2>Table: Category</h2>";
    $id = 1;
 
    print "<h3>Via Button with pre-defined values</h3>
            <p>Existing category id = $id</p>
            <button onclick=\"select_from_category($id)\">Submit</button>";

    echo "<p id=\"select_from_category_response\"></p>";


    ?>






    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/jquery-3.2.1.min.js"></script>
    <script src="../bootstrap/popper.min.js"></script>
    <script src="../bootstrap/bootstrap.min.js"></script>
  </body>
</html>
