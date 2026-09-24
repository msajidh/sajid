<?php
// selects a row to the `discounts` table in database `bookstore`. Takes in input the row values to be selected and outputs a JSON with response code and selected id.

// **REQUIRES**
// A JSON object named "discounts_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// discounts_select_input_query = 
//     {
//         Key: "id" 
//         Value: the discount's id - should be able to be converted into type int(11)
//     }

// **ENSURES**
// the discounts is returned by the id
// A JSON response is outputted, "discounts_select_output_response" which is formed as:

// discounts_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <SELECTED ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `discounts` WHERE `id`=?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["discounts_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$id = number_format($select_input_query->id);
ChromePhp::log("\nid=$id");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("i", $id);
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

$discounts_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$discounts_select_output_response");

print $discounts_select_output_response;
?> 