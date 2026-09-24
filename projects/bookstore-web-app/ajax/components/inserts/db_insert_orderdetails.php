<?php
// Inserts a row to the `orderdetails` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "orderdetails_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// orderdetails_insert_input_query = 
//     {

//         Key: "orderId"
//         Value: the customer's order id - should be able to be converted into type int(11)

//         Key: "quantity" 
//         Value: the customer's order quantity - should be able to be converted into type int(4)

//         Key: "bookId"
//         Value: the ordered book id should be able to be converted into type varchar(13)

//     }

// **ENSURES**
// a new row is inserted into the orderdetails table in the database with the passed attributes.
// A JSON response is outputted, "orderdetails_insert_output_response" which is formed as:

// orderdetails_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `orderdetails`(`orderId`, `quantity`, `bookId`) VALUES (?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["orderdetails_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$orderId = number_format($insert_input_query->orderId);
ChromePhp::log("\norderId=$orderId");

$quantity = number_format($insert_input_query->quantity);
ChromePhp::log("\nquantity=$quantity");

$bookId = $insert_input_query->bookId;
ChromePhp::log("\nbookId=$bookId");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("iis", $orderId, $quantity, $bookId);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to orderdetails: orderdetails_id=$insert_id");

$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$orderdetails_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$orderdetails_insert_output_response");

print $orderdetails_insert_output_response;
?>