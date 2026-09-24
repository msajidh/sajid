<?php
// selects the reviews of a customer, through the `reviews` table in database `bookstore`. Takes in input the customerid whose ratings is to be selectd and outputs a JSON with response code and selected rows.

// **REQUIRES**
// A JSON object named "reviews_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// reviews_update_input_query = 
//     {
//         Key: "id"
//         Value: the review's database id - should be able to be converted into type int(11)

//         Key: "ratingId"
//         Value: the books rating id - should be able to be converted into type int(11)

//         Key: "review" 
//         Value: the book review - should be able to be converted into type varchar(500)

//         Key: "dateUpdated"
//         Value: the review date should be able to be converted into type datetime
//
//     }

// **ENSURES**
// a row is updated in the category table in the database with the passed attributes.
// A JSON response is outputted, "reviews_update_output_response" which is formed as:

// reviews_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `reviews` SET `ratingId`=?,`review`=?,`dateUpdated`=? WHERE `id`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["reviews_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$ratingId = number_format($insert_input_query->ratingId);
ChromePhp::log("\nratingId=$ratingId");

$review = $insert_input_query->review;
ChromePhp::log("\nreview=$review");

$dateUpdated = $insert_input_query->dateUpdated;
ChromePhp::log("\ndateUpdated=$dateUpdated");



// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("iss", $ratingId, $review, $dateUpdated);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

// get the id of the update
$update_id ="null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated reviews: update_id=$update_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$update_id";
$reviews_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$reviews_update_output_response");

print $reviews_update_output_response;
?>