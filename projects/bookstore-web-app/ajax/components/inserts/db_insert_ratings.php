<?php
// Inserts a row to the `ratings` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "ratings_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// ratings_insert_input_query = 
//     {
//         Key: "id"
//         Value: the review's database id - should be able to be converted into type int(11)

//         Key: "rating"
//         Value: the books rating id - should be able to be converted into type float

//         Key: "bookid" 
//         Value: the book review - should be able to be converted into type varchar(500)

//         Key: "customerid"
//         Value: the customer's database id - should be able to be converted into type int(11)

//         Key: "dateUpdated"
//         Value: the review date should be able to be converted into type datetime

//     }

// **ENSURES**
// a new row is inserted into the ratings table in the database with the passed attributes.
// A JSON response is outputted, "ratings_insert_output_response" which is formed as:

// ratings_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `ratings`(`id`, `rating`, `bookId`, `customerId`, `dateUpdated`) VALUES (?,?,?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["ratings_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);

// Parse the POST-ed JSON input object into individual attributes
$id = number_format($insert_input_query->id);
ChromePhp::log("\nid=$id");

$rating = number_format($insert_input_query->rating);
ChromePhp::log("\nrating=$rating");

$bookId = $insert_input_query->bookId;
ChromePhp::log("\nbookId=$bookId");

$customerId = number_format($insert_input_query->customerId);
ChromePhp::log("\ncustomerId=$customerId");

$dateUpdated = $insert_input_query->dateUpdated;
ChromePhp::log("\ndateUpdated=$dateUpdated");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("idsis", $id, $rating, $bookId, $customerId, $dateUpdated);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to ratings: ratings_id=$insert_id");

$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$ratings_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$ratings_insert_output_response");

print $ratings_insert_output_response;
?>