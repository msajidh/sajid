<?php
// selects the bookdiscounts of a customer, through the `bookdiscounts` table in database `bookstore`. Takes in input the customerid whose bookdiscounts is to be selectd and outputs a JSON with response code and selected rows.

// **REQUIRES**
// A JSON object named "bookdiscounts_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// bookdiscounts_select_input_query = 
//     {
//         Key: "discountid"
//         Value: the customer's database id - should be able to be converted into type int 
//     }

// **ENSURES**
// the customer's bookdiscounts is returned, i.e, all bookids and quantity in that customer's bookdiscounts
// A JSON response is outputted, "bookdiscounts_select_output_response" which is formed as:

// bookdiscounts_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": [{"bookId": <book ID>,
//                       "discountId": <discount ID>, 
//                      }...]
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `bookdiscounts` WHERE `discountId`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["bookdiscounts_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$discountid = number_format($select_input_query->discountid);
ChromePhp::log("\ndiscountid=$discountid");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("i",$discountid);

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

$bookdiscounts_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$bookdiscounts_select_output_response");

print $bookdiscounts_select_output_response;
?>