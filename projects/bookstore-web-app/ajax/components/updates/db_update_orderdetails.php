<?php
// Updates the quantity of a book in a customer's orderdetails, through the `orderdetails` table in database `bookstore`. Takes in input the quantity to be updated and outputs a JSON with response code and update id.

// **REQUIRES**
// A JSON object named "orderdetails_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// orderdetails_update_input_query = 
//     {
//         Key: "orderId"
//         Value: the customer's order id - should be able to be converted into type int 

//         Key: "bookId" 
//         Value: the book's database id (i.e, ISBN) - should be able to be converted into type varchar(13)

//         Key: "quantity"
//         Value: the quantity of books the customer wants to add to their orderdetails - should be able to be converted into type int
//     }

// **ENSURES**
// a row is updated in the orderdetails table in the database with the passed attributes.
// A JSON response is outputted, "orderdetails_update_output_response" which is formed as:

// orderdetails_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `orderdetails` SET `quantity`=? WHERE `orderId`=? and `bookId`=?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["orderdetails_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$orderId = number_format($update_input_query->orderId);
ChromePhp::log("\norderId=$orderId");

$bookId = $update_input_query->bookId;
$quantity = number_format($update_input_query->quantity);

ChromePhp::log("\nbookid=$bookId");
ChromePhp::log("\nquantity=$quantity");


// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("iis",$quantity, $orderId, $bookId);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

// get the id of the update
$updated_rows = "null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated orderdetails: orderdetails_id=$updated_rows");

$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$updated_rows";
$orderdetails_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$orderdetails_update_output_response");

print $orderdetails_update_output_response;
?>