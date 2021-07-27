<?php
// selects the ratings of a customer, through the `ratings` table in database `bookstore`. Takes in input the customerid whose ratings is to be selectd and outputs a JSON with response code and selected rows.

// **REQUIRES**
// A JSON object named "ratings_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// ratings_update_input_query = 
//     {
//         Key: "id"
//         Value: the review's database id - should be able to be converted into type int(11)

//         Key: "rating"
//         Value: the books rating id - should be able to be converted into type int(11)

//         Key: "bookid" 
//         Value: the book review - should be able to be converted into type varchar(500)

//         Key: "customerid"
//         Value: the customer's database id - should be able to be converted into type int(11)

//         Key: "dateUpdated"
//         Value: the review date should be able to be converted into type datetime
//
//     }

// **ENSURES**
// a row is updated in the category table in the database with the passed attributes.
// A JSON response is outputted, "ratings_update_output_response" which is formed as:

// ratings_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `ratings` SET `rating`=?, `bookid`=?, `customerid`=?, `dateUpdated`=?`ratingId`=? WHERE `id`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["ratings_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$rating = number_format($insert_input_query->rating);
ChromePhp::log("\nrating=$rating");

$bookId = $insert_input_query->bookId;
ChromePhp::log("\ncustomerId=$bookId");

$customerId = $insert_input_query->customerId;
ChromePhp::log("\ncustomerId=$customerId");

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
$stmt->bind_param("isis", $rating, $bookId, $customerId, $dateUpdated);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

// get the id of the update
$update_id ="null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated ratings: update_id=$update_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$update_id";
$ratings_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$ratings_update_output_response");

print $ratings_update_output_response;
?>