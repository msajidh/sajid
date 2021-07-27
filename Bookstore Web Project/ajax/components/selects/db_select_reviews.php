<?php
// selects the reviews of a customer, through the `reviews` table in database `bookstore`. Takes in input the customerid whose reviews is to be selectd and outputs a JSON with response code and selected rows.

// **REQUIRES**
// A JSON object named "reviews_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// reviews_select_input_query = 
//     {
//         Key: "id"
//         Value: the reviews id - should be able to be converted into type int(11)
//     }

// **ENSURES**
// the customer's reviews is returned, i.e, all bookids and quantity in that customer's reviews
// A JSON response is outputted, "reviews_select_output_response" which is formed as:

// reviews_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": [{"orderId": <order ID>,
//                       "bookId": <book ID> , 
//                       "quantity": <quantity>
//                      }...]
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `reviews` WHERE `id`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["reviews_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$id = number_format($select_input_query->id);
ChromePhp::log("\nid=$id");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("i",$id);

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

$reviews_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$reviews_select_output_response");

print $reviews_select_output_response;
?>