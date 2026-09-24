<?php
// Updates the first name and second name of an author, through the `author` table in database `bookstore`. Takes in input the first name and second name to be updated and outputs a JSON with response code and update id.

// **REQUIRES**
// A JSON object named "author_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// author_update_input_query = 
//     {
//         Key: "id"
//         Value: the author's database id - should be able to be converted into type int(11)
//
//         Key: "firstName" 
//         Value: the author's first name - should be able to be converted into type varchar(100)
//
//         Key: "secondName"
//         Value: the author's second/last name - should be able to be converted into type varchar(100)
//
//     }

// **ENSURES**
// a row is updated in the category table in the database with the passed attributes.
// A JSON response is outputted, "author_update_output_response" which is formed as:

// author_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `author` SET `firstName`=?,`secondName`=? WHERE `id`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["author_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$id = number_format($update_input_query->id);
ChromePhp::log("\nid=$id");

$firstName = $update_input_query->firstName;
ChromePhp::log("\nfirstName=$firstName");

$secondName = $update_input_query->secondName;
ChromePhp::log("\nsecondName=$secondName");



// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("ssi",$firstName, $secondName, $id);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

// get the id of the update
$update_id ="null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated author: update_id=$update_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$update_id";
$author_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$author_update_output_response");

print $author_update_output_response;
?>