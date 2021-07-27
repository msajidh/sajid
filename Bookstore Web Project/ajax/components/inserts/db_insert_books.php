<?php
// Inserts a row to the `books` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "books_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// books_insert_input_query = 
//     {
//         Key: "isbn"
//         Value: the book's database id - should be able to be converted into type varchar(13) 
//          
//         key: "title"
//         value: the title of the book the admin wants to add to the database-should be able to be converted into type varchar(200)
//
//         key: "description"
//         value: the description of the book- should be able to be converted into type varchar(500)
//
//         key: "price"
//         value: the price of the book- should be able to be converted into type float
//
//         key: "categoryId"
//         value: the book's category id in the database -should be able to be converted into type int(11)
//
//         key: "previewLink"
//         value: the book's preview link as URL- should be able to be converted into type varchar(500)
//         
//         key: "publicationDate"
//         value: the book's date of publication- should be able to be converted to type date
//
//         key: "edition"
//         value: the book's edition- should be able to be converted to type int
//
//         key: "publisherId"
//         value: the book's publisher's Id in the database- should be able to be converted to type int
//
//         Key: "displayImage" 
//         Value: the book's image (cover) to be displayed as URL link - should be able to be converted into type varchar(500)
//     }

// **ENSURES**
// a new row is inserted into the books table in the database with the passed attributes.
// A JSON response is outputted, "books_insert_output_response" which is formed as:

// books_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `books`(`isbn`, `title`, `description`, `price`, `categoryId`, `previewLink`, `publicationDate`, `edition`, `publisherId`, `displayImage`) VALUES (?,?,?,?,?,?,?,?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["books_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$isbn = $insert_input_query->isbn;
ChromePhp::log("\nisbn=$isbn");

$title = $insert_input_query->title;
ChromePhp::log("\ntitle=$title");

$description = $insert_input_query->description;
ChromePhp::log("\ndescription=$description");

$price = number_format($insert_input_query->price);
ChromePhp::log("\nprice=$price");

$categoryId = number_format($insert_input_query->categoryId);
ChromePhp::log("\ncategoryId=$categoryId");

$previewLink = $insert_input_query->previewLink;
ChromePhp::log("\npreviewLink=$previewLink");

$publicationDate = $insert_input_query->publicationDate;
ChromePhp::log("\npublicationDate=$publicationDate");

$edition = number_format($insert_input_query->edition);
ChromePhp::log("\nedition=$edition");

$publisherId = number_format($insert_input_query->publisherId);
ChromePhp::log("\npublisherId=$publisherId");

$displayImage = $insert_input_query->displayImage;
ChromePhp::log("\ndisplayImage=$displayImage");


// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("sssdissiis", $isbn, $title, $description, $price, $categoryId, $previewLink, $publicationDate, $edition, $publisherId, $displayImage);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to books: book_insert_id=$insert_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$books_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$books_insert_output_response");

print $books_insert_output_response;
?>