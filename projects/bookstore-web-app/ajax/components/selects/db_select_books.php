<?php
// selects a book, through the `book` table in database `bookstore`. Takes in input the isbn which book to be selectd and outputs a JSON with response code and selected row.

// **REQUIRES**
// A JSON object named "books_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// books_select_input_query = 
//     {
//         Key: "isbn"
//         Value: the book's database id - should be able to be converted into type varchar(13)
//     }

// **ENSURES**
// the book is returned, i.e, isbn, title, description, price, categoryId, previewLink, publicationDate, edition, publisherId, displayImage
// A JSON response is outputted, "books_select_output_response" which is formed as:

// books_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <SELECTED ROWS>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql ="SELECT * FROM `books` WHERE `isbn`= ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["books_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$isbn = $select_input_query->isbn;
ChromePhp::log("\nisbn=$isbn");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("s",$isbn);


ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");


$response = json_decode("{}");

$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$res = $stmt->get_result();
$r = $res->fetch_all(MYSQLI_ASSOC);
$response->response = json_encode($r);

$books_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$books_select_output_response");

print $books_select_output_response;
?>