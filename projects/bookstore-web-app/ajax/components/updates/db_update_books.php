<?php
// Updates the title, desciption, price, categoryId, previewLink,publicationId, eition, displayImage of a book through the `books` table in database `bookstore`. Takes in input the title, desciption, price, categoryId, previewLink, publicationId, eition, displayImage to be updated and outputs a JSON with response code and update id.

// **REQUIRES**
// A JSON object named "books_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// books_update_input_query = 
//     {
//             Key: "isbn"
//             Value: the book's database id - should be able to be converted into type varchar(13) 
//          
//             key: "title"
//             value: the title of the book the admin wants to add to the database-should be able to be converted into type varchar(200)
//
//             key: "description"
//             value: the description of the book- should be able to be converted into type varchar(500)
//
//             key: "price"
//             value: the price of the book- should be able to be converted into type float
//
//             key: "categoryId"
//             value: the book's category id in the database -should be able to be converted into type int(11)
//
//             key: "previewLink"
//             value: the book's preview link as URL- should be able to be converted into type varchar(500)
//         
//             key: "publicationDate"
//             value: the book's date of publication- should be able to be converted to type date
//
//             key: "edition"
//             value: the book's edition- should be able to be converted to type int
//
//             key: "publisherId"
//             value: the book's publisher's Id in the database- should be able to be converted to type int
//
//             Key: "displayImage" 
//             Value: the book's image (cover) to be displayed as URL link - should be able to be converted into type varchar(500)
//     }

// **ENSURES**
// a row is updated in the books table in the database with the passed attributes.
// A JSON response is outputted, "books_update_output_response" which is formed as:

// books_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `books` SET `title`=?, `description`=?,`price`=?,`categoryId`=?, `previewLink`=?, `publicationDate`=?, `edition`=?, `displayImage`=? WHERE `isbn`=? and `publisherId`=?";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["books_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes
$isbn = $update_input_query->isbn;
ChromePhp::log("\nisbn=$isbn");

$title = $update_input_query->title;
ChromePhp::log("\ntitle=$title");

$description = $update_input_query->description;
ChromePhp::log("\ndescription=$description");

$price = number_format($update_input_query->price, 2);
ChromePhp::log("\nprice=$price");

$categoryId = number_format($update_input_query->categoryId);
ChromePhp::log("\ncategoryId=$categoryId");

$previewLink = $update_input_query->previewLink;
ChromePhp::log("\npreviewLink=$previewLink");

$publicationDate = $update_input_query->publicationDate;
ChromePhp::log("\npublicationDate=$publicationDate");

$edition = number_format($update_input_query->edition);
ChromePhp::log("\nedition=$edition");

$publisherId = number_format($update_input_query->publisherId);
ChromePhp::log("\npublisherId=$publisherId");

$displayImage = $update_input_query->displayImage;
ChromePhp::log("\ndisplayImage=$displayImage");


// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("ssdississi", $title, $description, $price, $categoryId, $previewLink, $publicationDate, $edition, $displayImage, $isbn, $publisherId,);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

// get the id of the update

$update_id = "null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated book: update_id = $update_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$update_id";
$books_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$books_update_output_response");

print $books_update_output_response;
?>