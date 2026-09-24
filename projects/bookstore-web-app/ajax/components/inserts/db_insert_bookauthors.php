<?php
// Inserts a row to the `bookauthors` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "bookauthors_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// bookauthors_insert_input_query = 
//     {
//         Key: "bookId"
//         Value: the book's database id (i.e., ISBN) - should be able to be converted into varchar(13)

//         Key: "authorId" 
//         Value: the author's database id - should be able to be converted into type int
//     }

// **ENSURES**
// a new row is inserted into the bookauthors table in the database with the passed attributes.
// A JSON response is outputted, "bookauthors_insert_output_response" which is formed as:

// bookauthors_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();
$sql = "INSERT INTO `bookauthors`(`bookId`, `authorId`) VALUES (?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["bookauthors_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$bookId = $insert_input_query->bookId;
ChromePhp::log("\nbookId=$bookId");

$authorId = number_format($insert_input_query->authorId);
ChromePhp::log("\nauthorId=$authorId");


// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("si", $bookId, $authorId);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to bookauthors: bookauthor_id=$insert_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$bookauthors_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$bookauthors_insert_output_response");

print $bookauthors_insert_output_response;
?>