<?php
// selects the orders of a customer, through the `orders` table in database `bookstore`. Takes in input the customerid whose orders is to be selectd and outputs a JSON with response code and selected rows.

// **REQUIRES**
// A JSON object named "orders_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// orders_select_input_query = 
//     {
//         Key: "customerId"
//         Value: the customer's id - should be able to be converted into type int(11)
//     }

// **ENSURES**
// the customer's orders is returned, i.e, orderDate, status, extraDetails, promoCode, paymentMethod, totalPrice, discount, finalPrice, currency
// A JSON response is outputted, "orders_select_output_response" which is formed as:

// orders_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <SELECTED ROWS>
//                       
//                       
//                      
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `orders` WHERE `customerId`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["orders_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$customerId = number_format($select_input_query->customerId);
ChromePhp::log("\ncustomerId=$customerId");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("i",$customerId);

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

$orders_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$orders_select_output_response");

print $orders_select_output_response;
?>