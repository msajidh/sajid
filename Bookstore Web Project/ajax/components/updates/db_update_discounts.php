<?php
// Updates a row to the `discounts` table in database `bookstore`. Takes in input the row values to be updated and outputs a JSON with response code and update id.

// **REQUIRES**
// A JSON object named "discounts_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// discounts_update_input_query = 
//     {
//        Key: "id"
//        Value: the admin's database id - should be able to be converted into type int 

//        Key: "type" 
//        Value: the type of discount should be able to be converted into type varchar(10) 

//        Key: "code" 
//        Value: the code of discount should be able to be converted into type varchar(10) 

//        Key: "value" 
//        Value: the value of discount should be able to be converted into type float

//        Key: "maxdiscountid" 
//        Value: the discount amount of order should be able to be converted into type float
//     }

// **ENSURES**
// a row is updated into the discounts table in the database with the passed attributes.
// A JSON response is outputted, "discounts_update_output_response" which is formed as:

// discounts_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `discounts`SET `type`=?,`code`=?, `value`=?,`maxDiscount`=? WHERE `id`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["discounts_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$id = $update_input_query->id;
ChromePhp::log("\nid=$id");

$type = number_format($update_input_query->type);
ChromePhp::log("\ntype=$type");

$code = $update_input_query->code;
ChromePhp::log("\ncode=$code");

$value = number_format($update_input_query->value);
ChromePhp::log("\nvalue=$value);

$maxDiscount = number_format($update_input_query->maxDiscount);
ChromePhp::log("\nmaxDiscount=$maxDiscount"); 

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("issdd", $id, $type, $code, $value, $maxDiscount);

// executes statement
$stmt->execute();

// get the id of the update
$update_id = $mysqli->update_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to discounts: book_update_id=$update_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$update_id";
$discounts_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$discounts_update_output_response");

print $discounts_update_output_response;
?>