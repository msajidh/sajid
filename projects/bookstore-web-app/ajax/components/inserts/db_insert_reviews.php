<?php
// Inserts a row to the `reviews` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "reviews_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// reviews_insert_input_query = 
//     {

//         Key: "ratingId"
//         Value: the books rating id - should be able to be converted into type int(11)

//         Key: "review" 
//         Value: the book review - should be able to be converted into type varchar(500)

//         Key: "dateUpdated"
//         Value: the review date should be able to be converted into type datetime

//     }

// **ENSURES**
// a new row is inserted into the reviews table in the database with the passed attributes.
// A JSON response is outputted, "reviews_insert_output_response" which is formed as:

// reviews_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `reviews`(`ratingId`, `review`, `dateUpdated`) VALUES (?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["reviews_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$ratingId = number_format($insert_input_query->ratingId);
ChromePhp::log("\nratingId=$ratingId");

$review = $insert_input_query->review;
ChromePhp::log("\nreview=$review");

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
$stmt->bind_param("iss", $ratingId, $review, $dateUpdated);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to reviews: reviews_id=$insert_id");

$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$reviews_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$reviews_insert_output_response");

print $reviews_insert_output_response;
?>