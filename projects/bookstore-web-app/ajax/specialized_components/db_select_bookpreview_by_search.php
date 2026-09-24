<?php
// selects a row to the `bookpreview` table in database `bookstore`. Takes in input the id of the bookpreview to be selected and outputs a JSON with response code and select id.

// **REQUIRES**
// A JSON object named "bookpreview_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// bookpreview_select_input_query = 
//     {
//         Key: "query"
//         Value: the search query
//          
//         Key: "offset"
//         Value: the number of rows to be skipped
//         
//         Key: "limit"
//         Value: the number of rows to be output
// 
//         Key: "orderBy"
//         Value: null or an existing row in bookpreviews, if null then results are ordered by price low to high
//     }

// **ENSURES**
// the bookpreview is returned by the id
// A JSON response is outputted, "bookpreview_select_output_response" which is formed as:

// bookpreview_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": [{"authorName": <authorName>,
//                       "authorId": <	authorId>,
//                       "bookId": <bookId>,
//                       "isbn": <isbn>,
//                       "title": <title>,
//                       "description": <description>,
//                       "price": <price>,
//                       "categoryId": <categoryId>,
//                       "previewLink": <previewLink>,
//                       "edition": <edition>,
//                       "publicationDate": <publicationDate>,
//                       "publisherId": <publisherId>,
//                       "displayImage": <displayImage>,
//                       "type": <publisher type>,
//                       "name": <category name>  }...]
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../debug/chromephp-master/ChromePhp.php";

require "../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `bookpreview` WHERE `title` LIKE CONCAT(CONCAT('%', ?), '%') or `authorName` LIKE CONCAT(CONCAT('%', ?), '%') or `description` LIKE CONCAT(CONCAT('%', ?), '%') or `name` LIKE CONCAT(CONCAT('%', ?), '%') ORDER BY ? LIMIT ?, ?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["bookpreview_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$query = $select_input_query->query;
ChromePhp::log("\nquery=$query");


$offset = number_format($select_input_query->offset);
ChromePhp::log("\noffset=$offset");


$limit = number_format($select_input_query->limit);
ChromePhp::log("\nlimit=$limit");


$orderBy = ($select_input_query->orderBy);
if(strcmp($orderBy, "null") == 0)
{
    $orderBy = "price";
}
ChromePhp::log("\norderBy=$orderBy");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);
ChromePhp::log("Prepared");
// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("sssssii", $query, $query, $query, $query, $orderBy, $offset, $limit);
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

$bookpreview_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$bookpreview_select_output_response");

print $bookpreview_select_output_response;
?>