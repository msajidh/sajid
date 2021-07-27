<?php
// Updates the bookId, discountId of a book through the `bookdiscounts` table in database `bookstore`. Takes in input the bookId, and discountId.

// **REQUIRES**
// A JSON object named "bookdiscounts_update_input_query" must be POSTed to this file with the following key-value pairs:

// bookdiscounts_update_input_query = 
//     {
//        Key: "bookid" 
//        Value: the book's database id (i.e, ISBN) - should be able to be converted into type varchar(13) 

//        Key: "discountid" 
//        Value: the customer's database id - should be able to be converted into type int 
//     }

// **ENSURES**
// a row is updated in the books table in the database with the passed attributes.
// A JSON response is outputted, "bookdiscounts_update_output_response" which is formed as:

// bookdiscounts_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `bookdiscounts` SET `bookId`=? and `discountId`=?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["bookdiscounts_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$bookId = $update_input_query->bookId;
ChromePhp::log("\nbookId=$bookId");

$discountId = number_format($update_input_query->discountId);
ChromePhp::log("\ndiscountId=$discountId");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("si", $bookId, $discountId);

ChromePhp::log("Parameters Bound"); 

// executes statement
$stmt->execute(); 

ChromePhp::log("SQL Executed"); 

// get the id of the update
$update_id = "null";


// REMOVE - TO DO 🔲
ChromePhp::log("Updated bookdiscounts: update_id=$update_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$update_id";
$bookdiscounts_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$bookdiscounts_update_output_response");

print $bookdiscounts_update_output_response;
?>