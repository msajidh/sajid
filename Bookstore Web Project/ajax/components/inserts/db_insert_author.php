<?php
// Inserts a row to the `author` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "author_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// author_insert_input_query = 
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
// a new row is inserted into the author table in the database with the passed attributes.
// A JSON response is outputted, "author_insert_output_response" which is formed as:

// author_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();
$sql = "INSERT INTO `author`(`firstName`, `secondName`) VALUES (?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["author_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

//$id = number_format($insert_input_query->id);
//ChromePhp::log("\nid=$id");

$firstName = $insert_input_query->firstName;
ChromePhp::log("\nfirstName=$firstName");

$secondName = $insert_input_query->secondName;
ChromePhp::log("\nsecondName=$secondName");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("ss", $firstName, $secondName);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to author: new author_id=$insert_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$author_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$author_insert_output_response");

print $author_insert_output_response;
?>