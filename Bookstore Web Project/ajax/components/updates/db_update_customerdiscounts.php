<?php
// Updates the customerId, discountId of a book through the `customerdiscounts` table in database `bookstore`. Takes in input the customerId, nd discountId.

// **REQUIRES**
// A JSON object named "customerdiscounts_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// customerdiscounts_update_input_query = 
//     {
//        Key: "customerid"
//        Value: the customer's database id - should be able to be converted into type int 

//        Key: "discountid" 
//        Value: the customer's database id - should be able to be converted into type int 
//     }

// **ENSURES**
// a new row is updated into the customerdiscounts table in the database with the passed attributes.
// A JSON response is outputted, "customerdiscounts_update_output_response" which is formed as:

// customerdiscounts_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `customerdiscounts` SET `customerId`=? and `discountId`=?"; 

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["customerdiscounts_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$customerId = $update_input_query->customerId;
ChromePhp::log("\ncustomerId=$customerId");

$discountId = $update_input_query->discountId;
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
$stmt->bind_param("is", $customerId, $discountId);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();

ChromePhp::log("SQL Executed");

// get the id of the update
$update_id = "null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated customerdiscounts: update_id = $update_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$update_id";
$customerdiscounts_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$customerdiscounts_update_output_response");

print $customerdiscounts_update_output_response;
?>