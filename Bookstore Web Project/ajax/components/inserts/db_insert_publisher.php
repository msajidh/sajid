<?php
// Inserts a row to the `publisher` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "publisher_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// publisher_insert_input_query = 
//     {
//         Key: "type" 
//         Value: the publisher's type - should be able to be converted into type varchar(100)
//     }

// **ENSURES**
// a new row is inserted into the publisher table in the database with the passed attributes.
// A JSON response is outputted, "publisher_insert_output_response" which is formed as:

// publisher_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `publisher`(`type`) VALUES (?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["publisher_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$type = $insert_input_query->type;
ChromePhp::log("\ntype=$type");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("s", $type);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to publisher: new publisher's id=$insert_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$publisher_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$publisher_insert_output_response");

print $publisher_insert_output_response;
?>