<?php
// selects a customers, through the `customers` table in database `bookstore`. Takes in input the id of the customer to be selectd and outputs a JSON with response code and selected row.

// **REQUIRES**
// A JSON object named "customers_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// customers_select_input_query = 
//     {
//         Key: "id"
//         Value: the customer's database id - should be able to be converted into type int(13)
//     }

// **ENSURES**
// the customer is returned, i.e, `id`, `email`, `firstName`, `lastName`, `postalCode`, `street`, `addessLine1`, `addressLine2`, `city`, `country`, `phone`, `username`, `passwordencrypted`, `isAdmin`, `emailVerified`, `phoneVerified`, `registrationDate`, `lastOnline`, `referralCode`, `referredBy`, `dataStoragePermission`, `dob`
// A JSON response is outputted, "customers_select_output_response" which is formed as:

// customers_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <SELECTED ROWS>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `customers` WHERE `id`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["customers_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$id = $select_input_query->id;
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

$customers_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$customers_select_output_response");

print $customers_select_output_response;
?>