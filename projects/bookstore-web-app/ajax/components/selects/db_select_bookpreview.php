<?php
// selects a row to the `bookpreview` table in database `bookstore`. Takes in input the id of the bookpreview to be selected and outputs a JSON with response code and select id.

// **REQUIRES**
// A JSON object named "bookpreview_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// bookpreview_select_input_query = 
//     {
//         Key: "queryBy"
//         Value: the value by which to query the bookpreview view by, null if all the bookpreview rows are required. Legal values include "isbn", "categoryid", "publisherid"
//          Key: if queryBy != null then this is the column being queried by 
//          Value: value to query by
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
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "SELECT * FROM `bookpreview`";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["bookpreview_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$queryBy = $select_input_query->queryBy;
ChromePhp::log("\nqueryBy=$queryBy");

$value = "";
$sql = $sql . " WHERE `" . $queryBy . "` = ?";
$type = "";
ChromePhp::log("\nsql=$sql");
if(strcmp($queryBy, "isbn") == 0)
{
    $value = $select_input_query->$queryBy; 
    $type = "s";
}
else
{
    $value = number_format($select_input_query->$queryBy);
    $type = "i";
}
ChromePhp::log("\nqueryBy=$queryBy");
ChromePhp::log("\nvalue=$value");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param($type, $value);
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