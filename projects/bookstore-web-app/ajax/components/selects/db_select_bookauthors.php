<?php
// Selects a row to the `bookauthors` table in database `bookstore`. Takes in input the bookauthor's id to be selected and outputs a JSON with response code and selected row.

// **REQUIRES**
// A JSON object named "bookauthors_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// bookauthors_select_input_query = 
//     {
//        Key: "queryFor" 
//        Value: what information does the POSTer need - what is the output column name? in database key. Allowed values = "bookId" or "authorId"
// 
//        Key: depends based on queryFor value - what is the input passed? If queryFor = "bookId" then this key is "authorId" and vice versa
//        Value: value of the key with the type needed 
//     }

// **ENSURES**
// the bookauthor is returned, i.e, bookid, authorid.
// A JSON response is outputted, "bookauthors_select_output_response" which is formed as:

// bookauthors_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <SELECTED ROWS>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `bookauthors`";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["bookauthors_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$queryFor = $select_input_query->queryFor;
$queryValue = "";
$queryType = "";

if(strcmp($queryFor, "authorId") == 0)
{
    $queryValue = $select_input_query->bookId;
    $queryType = "s";
    $sql = $sql . " WHERE `bookId`= ?";
}
else if(strcmp($queryFor, "bookId") == 0)
{
    $queryValue = $select_input_query->authorId;
    $queryType = "i";
    
    $sql = $sql . " WHERE `authorId`= ?";
}
ChromePhp::log("\nqueryValue=$queryValue");

// log to console
ChromePhp::log($sql);
// prepares the SQL statement
$stmt = $mysqli->prepare($sql);
ChromePhp::log("Query Prepared");

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param($queryType, $queryValue); 

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

$bookauthors_select_output_response = json_encode($response);


// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$bookauthors_select_output_response");

print $bookauthors_select_output_response;
?> 