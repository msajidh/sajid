<?php
// selects a row to the `author` table in database `bookstore`. Takes in input the id of the author to be selected and outputs a JSON with response code and select id.

// **REQUIRES**
// A JSON object named "author_select_input_query" must be POSTed to this file with the following key-value pairs:
 
// author_select_input_query = 
//     {
//         Key: "firstName" 
//         Value: the author's first name
// 
//         Key: "secondName" 
//         Value: the author's second name
//     }

// **ENSURES**
// the author is returned by the id
// A JSON response is outputted, "author_select_output_response" which is formed as:

// cart_select_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": [{"id": <author ID>,
//                       "name": <author name>}...]
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../debug/chromephp-master/ChromePhp.php";

require "../../internal/dbconnect.php";

session_start();

$sql = "SELECT * FROM `author` WHERE `firstName`= ? and `secondName`= ? ";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$select_input_query_encoded = $_REQUEST["author_select_input_query"];
$select_input_query = json_decode($select_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$firstname = ($select_input_query->firstName);
ChromePhp::log("\nfname=$firstName");


$secondname = ($select_input_query->secondName);
ChromePhp::log("\nsname=$secondName");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("ss", $firstname, $secondname);
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

$author_select_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$author_select_output_response");

print $author_select_output_response;
?>