<?php
// Inserts a row to the `wishlist` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "wishlist_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// wishlist_insert_input_query = 
//     {
//        Key: "customerid"
//        Value: the customer's database id - should be able to be converted into type int 

//        Key: "bookid" 
//        Value: the book's database id (i.e, ISBN) - should be able to be converted into type varchar(13) 

//        Key: "dateadded" 
//        Value: Value: the customer's order date - should be able to be converted into type datetime 
//     }

// **ENSURES**
// a new row is inserted into the wishlist table in the database with the passed attributes.
// A JSON response is outputted, "wishlist_insert_output_response" which is formed as:

// wishlist_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `wishlist`(`customerId`, `bookId`, `dateAdded`) VALUES (?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["wishlist_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$customerId = $insert_input_query->customerId;
ChromePhp::log("\ncustomerId=$customerId");

$bookId = $insert_input_query->bookId;
ChromePhp::log("\nbookId=$bookId");

$dateAdded = number_format($insert_input_query->dateAdded);
ChromePhp::log("\ndateAdded=$dateAdded");


// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("iss", $customerId, $bookId, $dateAdded);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to wishlist: book_insert_id=$insert_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$wishlist_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$wishlist_insert_output_response");

print $wishlist_insert_output_response;
?>