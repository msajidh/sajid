<?php
// Inserts a row to the `category` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "category_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// category_insert_input_query = 
//     {
//         Key: "name" 
//         Value: the category's name - should be able to be converted into type varchar(200)
//     }

// **ENSURES**
// a new row is inserted into the category table in the database with the passed attributes.
// A JSON response is outputted, "category_insert_output_response" which is formed as:

// category_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `category`(`name`) VALUES (?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["category_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$name = $insert_input_query->name;
ChromePhp::log("\nname=$name");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("s", $name);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to category: new category's id=$insert_id");

$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$category_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$category_insert_output_response");

print $category_insert_output_response;
?>