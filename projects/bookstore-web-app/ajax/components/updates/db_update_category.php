<?php
// Updates the quantity of a book in a customer's category, through the `category` table in database `bookstore`. Takes in input the quantity to be updated and outputs a JSON with response code and update id.

// **REQUIRES**
// A JSON object named "category_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// category_update_input_query = 
//     {
//         Key: "id"
//         Value: the category's id - should be able to be converted into type int(11)
// 
//         Key: "name" 
//         Value: the category's new name database id - should be able to be converted into type varchar(200)
//     }

// **ENSURES**
// a row is updated in the category table in the database with the passed attributes.
// A JSON response is outputted, "category_update_output_response" which is formed as:

// category_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `category` SET `name`=? WHERE `id`=?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["category_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$id = number_format($update_input_query->id);
ChromePhp::log("\nid=$id");

$name = $update_input_query->name;

ChromePhp::log("\nname=$name");


// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("si",$name, $id);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

// get the id of the update
$update_id = "null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated category: update_id=$update_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$update_id";
$category_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$category_update_output_response");

print $category_update_output_response;
?>