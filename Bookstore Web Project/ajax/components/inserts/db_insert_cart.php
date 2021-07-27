<?php
// Inserts a row to the `cart` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "cart_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// cart_insert_input_query = 
//     {
//         Key: "customerid"
//         Value: the customer's database id - should be able to be converted into type int 

//         Key: "bookid" 
//         Value: the book's database id (i.e, ISBN) - should be able to be converted into type varchar(13)

//         Key: "quantity"
//         Value: the quantity of books the customer wants to add to their cart - should be able to be converted into type int
//     }

// **ENSURES**
// a new row is inserted into the cart table in the database with the passed attributes.
// A JSON response is outputted, "cart_insert_output_response" which is formed as:

// cart_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `cart`(`customerId`, `bookId`, `quantity`) VALUES (?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["cart_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$customerid = number_format($insert_input_query->customerid);
ChromePhp::log("\ncustomerid=$customerid");

$bookid = $insert_input_query->bookid;
$quantity = number_format($insert_input_query->quantity);

ChromePhp::log("\nbookid=$bookid");
ChromePhp::log("\nquantity=$quantity");


// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("isi", $customerid, $bookid, $quantity);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to cart: cart_id=$insert_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$cart_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$cart_insert_output_response");

print $cart_insert_output_response;
?>