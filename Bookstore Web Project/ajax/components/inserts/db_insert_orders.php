<?php
// Inserts a row to the `orders` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "orders_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// orders_insert_input_query = 
//     {
//         Key: "customerId"
//         Value: the customer's database id - should be able to be converted into type int 

//         Key: "orderDate" 
//         Value: the customer's order date - should be able to be converted into type datetime

//         Key: "status"
//         Value: the status of order should be able to be converted into type varchar(10)

//         Key: "extraDetails"
//         Value: the order's extra details should be able to be converted into type varchar(500)

//         Key: "promoCode"
//         Value: the promo code of order should be able to be converted into type varchar(10)

//         Key: "paymentMethod"
//         Value: the payment method of order should be able to be converted into type varchar(10)

//         Key: "totalPrice"
//         Value: the total price of order should be able to be converted into type float

//         Key: "discount"
//         Value: the discount amount of order should be able to be converted into type float

//         Key: "finalPrice"
//         Value: the final price of order should be able to be converted into type float

//         Key: "currency"
//         Value: the currency of order should be able to be converted into type varcahr(3)

//     }

// **ENSURES**
// a new row is inserted into the orders table in the database with the passed attributes.
// A JSON response is outputted, "orders_insert_output_response" which is formed as:

// orders_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `orders`(`customerId`, `orderDate`, `status`, `extraDetails`, `promoCode`, `paymentMethod`, `totalPrice`, `discount`, `finalPrice`, `currency`) VALUES (?,?,?,?,?,?,?,?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["orders_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$customerId = number_format($insert_input_query->customerId);
ChromePhp::log("\ncustomerId=$customerId");

$orderDate = $insert_input_query->orderDate;
ChromePhp::log("\norderDate=$orderDate");

$status = $insert_input_query->status;
ChromePhp::log("\nstatus=$status");

$extraDetails = $insert_input_query->extraDetails;
ChromePhp::log("\nextraDetails=$extraDetails");

$promoCode = $insert_input_query->promoCode;
ChromePhp::log("\npromoCode=$promoCode");

$paymentMethod = $insert_input_query->paymentMethod;
ChromePhp::log("\npaymentMethod=$paymentMethod");

$totalPrice = number_format($insert_input_query->totalPrice,2);
ChromePhp::log("\ntotalPrice=$totalPrice");

$discount = number_format($insert_input_query->discount,2);
ChromePhp::log("\ndiscount=$discount");

$finalPrice = number_format($insert_input_query->finalPrice,2);
ChromePhp::log("\nfinalPrice=$finalPrice");

$currency = $insert_input_query->currency;
ChromePhp::log("\ncurrency=$currency");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("isssssddds", $customerId, $orderDate, $status, $extraDetails, $promoCode, $paymentMethod, $totalPrice, $discount, $finalPrice, $currency);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to orders: orders_id=$insert_id");

// ChromePhp::log("error=$stmt->error");

$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$orders_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$orders_insert_output_response");

print $orders_insert_output_response;
?>