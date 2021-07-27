<?php
// Updates the quantity of a book in a customer's orders, through the `orders` table in database `bookstore`. Takes in input the quantity to be updated and outputs a JSON with response code and update id.

// **REQUIRES**
// A JSON object named "orders_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// orders_update_input_query = 
//     {
//         Key: "id"
//         Value: the id - should be able to be converted into type int(11)

//         Key: "customerId"
//         Value: the customer's id - should be able to be converted into type int(11)

//         Key: "status"
//         Value: the status of orders - should be able to be converted into type varchar(10)

//         Key: "extraDetails"
//         Value: the extra details of orders - should be able to be converted into type varchar(500)

//         Key: "promoCode"
//         Value: the promo code of orders - should be able to be converted into type varchar(10)

//         Key: "paymentMethod"
//         Value: the payment method of order - should be able to be converted into type varchar(10)

//         Key: "totalPrice"
//         Value: the total price of order - should be able to be converted into type float

//         Key: "discount"
//         Value: the discount of order - should be able to be converted into type float

//         Key: "finalPrice"
//         Value: the final price of order - should be able to be converted into type float

//         Key: "currency"
//         Value: the currency of order - should be able to be converted into type varchar(3)

//     }

// **ENSURES**
// a row is updated in the orders table in the database with the passed attributes.
// A JSON response is outputted, "orders_update_output_response" which is formed as:

// orders_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `orders` SET  `status`=?,`extraDetails`=?, `promoCode`=?,`paymentMethod`=?, `totalPrice`=?, `discount`=?, `finalPrice`=?, `currency`=? WHERE `id`=?";


// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["orders_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$id = $update_input_query->id;
ChromePhp::log("\nid=$id");

// $orderDate = $update_input_query->orderDate;
// ChromePhp::log("\norderDate=$orderDate");

$status = $update_input_query->status;
ChromePhp::log("\nstatus=$status");

$extraDetails = $update_input_query->extraDetails;
ChromePhp::log("\nextraDetails=$extraDetails");

$promoCode = $update_input_query->promoCode;
ChromePhp::log("\npromoCode=$promoCode");

$paymentMethod = $update_input_query->paymentMethod;
ChromePhp::log("\npaymentMethod=$paymentMethod");

$totalPrice = number_format($update_input_query->totalPrice,2);
ChromePhp::log("\ntotalPrice=$totalPrice");

$discount = number_format($update_input_query->discount,2);
ChromePhp::log("\ndiscount=$discount");

$finalPrice = number_format($update_input_query->finalPrice,2);
ChromePhp::log("\nfinalPrice=$finalPrice");

$currency = $update_input_query->currency;
ChromePhp::log("\ncurrency=$currency");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
// $stmt->bind_param("isssssddds", $id, $orderDate, $status, $extraDetails, $promoCode, $paymentMethod, $totalPrice, $discount, $finalPrice, $currency);
$stmt->bind_param("ssssdddsi", $status, $extraDetails, $promoCode, $paymentMethod, $totalPrice, $discount, $finalPrice, $currency, $id);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

// get the id of the update
$updated_rows = "null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated orders: orders_id=$updated_rows");

$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$updated_rows";
$orders_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$orders_update_output_response");

print $orders_update_output_response;
?>