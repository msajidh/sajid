<?php
// Inserts a row to the `discounts` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "discounts_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// discounts_insert_input_query = 
//     {
//        Key: "id"
//        Value: the admin's database id - should be able to be converted into type int(11) 

//        Key: "type" 
//        Value: the type of discount should be able to be converted into type varchar(10) 

//        Key: "code" 
//        Value: the code of discount should be able to be converted into type varchar(10) 

//        Key: "value" 
//        Value: the value of discount should be able to be converted into type float

//        Key: "maxdiscount" 
//        Value: the discount amount of order should be able to be converted into type float
//     }

// **ENSURES**
// a new row is inserted into the discounts table in the database with the passed attributes.
// A JSON response is outputted, "discounts_insert_output_response" which is formed as:

// discounts_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `discounts`(`type`, `code`, `value`, `maxDiscount`) VALUES (?,?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["discounts_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$id = number_format($insert_input_query->id);
ChromePhp::log("\nid=$id");

$type = $insert_input_query->type;
ChromePhp::log("\ntype=$type");

$code = $insert_input_query->code;
ChromePhp::log("\ncode=$code");

$value = number_format($insert_input_query->value);
ChromePhp::log("\nvalue=$value);

$maxDiscount = number_format($insert_input_query->maxDiscount);
ChromePhp::log("\nmaxDiscount=$maxDiscount"); 

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("ssdd", $type, $code, $value, $maxDiscount);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to discounts: discounts_id=$insert_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$discounts_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$discounts_insert_output_response");

print $discounts_insert_output_response;
?>