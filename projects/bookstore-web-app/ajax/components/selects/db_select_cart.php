<?php
// selects the cart of a customer, through the `cart` table in database `bookstore`. Takes in input the customerid whose cart is to be selectd and outputs a JSON with response code and selected rows.

// **REQUIRES**
// A JSON object named "cart_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// cart_select_input_query = 
//     {
//         Key: "customerid"
//         Value: the customer's database id - should be able to be converted into type int 
//     }

// **ENSURES**
// the customer's cart is returned, i.e, all bookids and quantity in that customer's cart
// A JSON response is outputted, "cart_select_output_response" which is formed as:

// cart_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": [{"customerId": <Customer ID>,
//                       "bookId": <book ID> , 
//                       "quantity": <quantity>
//                      }...]
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `cart` WHERE `customerId`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["cart_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$customerid = number_format($select_input_query->customerid);
ChromePhp::log("\ncustomerid=$customerid");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("i",$customerid);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

$response = json_decode("{}");

$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$res = $stmt->get_result();
$r = $res->fetch_all(MYSQLI_ASSOC);
$response->response = json_encode($r);

$cart_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$cart_select_output_response");

print $cart_select_output_response;
?>