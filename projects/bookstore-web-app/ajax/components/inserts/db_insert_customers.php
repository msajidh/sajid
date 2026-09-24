<?php
//Inserts a row to the `customers` table in database `bookstore`. Takes in input the row values to be inserted and outputs a JSON with response code and insert id.

// **REQUIRES**
// A JSON object named "customers_insert_input_query" must be POSTed to this file with the following key-value pairs:
 
// customers_insert_input_query = 
//     {
//         Key: "id"
//         Value: the customers's database id - should be able to be converted into type int(13) 
//          
//         key: "email"
//         value: the email of the customer to add to the database-should be able to be converted into type varchar(50)
//
//         key: "firstName"
//         value: the firstName of the customer- should be able to be converted into type varchar(100)
//
//         key: "lastName"
//         value: the lastName of the customer- should be able to be converted into type varchar (100)
//
//         key: "postalCode"
//         value: the customer's postal code in the database -should be able to be converted into type int(6)
//
//         key: "street"
//         value: the customers's street- should be able to be converted into type varchar(100)
//         
//         key: "addressLine1"
//         value: the customer's address line- should be able to be converted to type varchar(100)
//
//         key: "addressLine2"
//         value: the customer's address line- should be able to be converted to type varchar(100)
//
//         key: "city"
//         value: the customer's city in the database- should be able to be converted to varchar(100)
//
//         Key: "country" 
//         Value: the customer's country - should be able to be converted into type varchar(3)
//
//         Key: "phone" 
//         Value: the customer's phonenumber - should be able to be converted into type varchar(20)

//         Key: "username" 
//         Value: the customer's username - should be able to be converted into type varchar(30)
//
//         key: "passwordencrypted"
//         value: the customer's password - should be able to be converted into type varchar(42)
//
//         key: "isAdmin"
//         value: the user's access status- should be able to be converted into type tinyint(1)
//
//         Key: "emailVerified"
//         value: the customer's email status- should be able to be converted into type tinyint(1)
//
//          Key: "phoneVerified"
//         value: the customer's phone status- should be able to be converted into type tinyint(1)
//
//          Key: "registrationDate"
//         value: the customer's date of registartion- should be able to be converted into type datetime
//
//          Key: "lastOnline"
//         value: the customer's last online status- should be able to be converted into type datetime
//
//          Key: "referralCode"
//         value: the referral code for customer- should be able to be converted into type varchar(10)
//
//          Key: "referredBy"
//         value: the referral code for customer- should be able to be converted into type varchar(10)
//
//          Key: "dataStoragePermission"
//         value: the permission for storing data related to the customer- should be able to be converted into type tinyint(10)
//     
//          Key: "dob"
//         value: the date of birth of customer- should be able to be converted into type date
//          }

// **ENSURES**
// a new row is inserted into the customers table in the database with the passed attributes.
// A JSON response is outputted, "customers_insert_output_response" which is formed as:

// customers_insert_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": <INSERT ID>
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "INSERT INTO `customers`(`email`, `firstName`, `lastName`, `postalCode`, `street`, `addessLine1`, `addressLine2`, `city`, `country`, `phone`, `username`, `passwordencrypted`, `isAdmin`, `emailVerified`, `phoneVerified`, `registrationDate`, `lastOnline`, `referralCode`, `referredBy`, `dataStoragePermission`, `dob`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$insert_input_query_encoded = $_REQUEST["customers_insert_input_query"];
$insert_input_query = json_decode($insert_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes


// $id = number_format($insert_input_query->id);
// ChromePhp::log("\nid=$id");

$email = $insert_input_query->email;
ChromePhp::log("\nemail=$email");

$firstName = $insert_input_query->firstName;
ChromePhp::log("\nfirstName=$firstName");

$lastName = $insert_input_query->lastName;
ChromePhp::log("\nlastName=$lastName");

$postalCode = number_format($insert_input_query->postalCode);
ChromePhp::log("\npostalCode=$postalCode");

$street = $insert_input_query->street;
ChromePhp::log("\nstreet=$street");

$addessLine1 = $insert_input_query->addessLine1;
ChromePhp::log("\naddressLine1=$addessLine1");

$addressLine2 = $insert_input_query->addressLine2;
ChromePhp::log("\naddressLine2=$addressLine2");

$city = $insert_input_query->city;
ChromePhp::log("\ncity=$city");

$country = $insert_input_query->country;
ChromePhp::log("\ncountry=$country");

$phone = $insert_input_query->phone;
ChromePhp::log("\nphone=$phone");

$username = $insert_input_query->username;
ChromePhp::log("\nusername=$username");

$passwordencrypted = $insert_input_query->passwordencrypted;
ChromePhp::log("\npasswordencrypted=$passwordencrypted");

$isAdmin = number_format($insert_input_query->isAdmin);
ChromePhp::log("\nisAdmin=$isAdmin");

$emailVerified = number_format($insert_input_query->emailVerified);
ChromePhp::log("\nemailVerified=$emailVerified");

$phoneVerified = number_format($insert_input_query->phoneVerified);
ChromePhp::log("\nphoneVerified=$phoneVerified");

$registrationDate = $insert_input_query->registrationDate;
ChromePhp::log("\nregistartionDate=$registrationDate");

$lastOnline = $insert_input_query->lastOnline;
ChromePhp::log("\nlastOnline=$lastOnline");

$referralCode = $insert_input_query->referralCode;
ChromePhp::log("\nreferralCode =$referralCode");

$referredBy = $insert_input_query->referredBy;
ChromePhp::log("\nreferredBy =$referredBy");

$dataStoragePermission = number_format($insert_input_query->dataStoragePermission);
ChromePhp::log("\ndataStoragePermission =$dataStoragePermission ");

$dob = $insert_input_query->dob;
ChromePhp::log("\ndob =$dob");


// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database
$stmt->bind_param("sssissssssssiiissssis", $email, $firstName, $lastName, $postalCode, $street, $addessLine1, $addressLine2, $city, $country, $phone, $username, $passwordencrypted, $isAdmin, $emailVerified, $phoneVerified, $registrationDate, $lastOnline, $referralCode, $referredBy, $dataStoragePermission, $dob);

// executes statement
$stmt->execute();

// get the id of the insert
$insert_id = $mysqli->insert_id;

// REMOVE - TO DO 🔲
ChromePhp::log("Added to customers: customers_insert_id=$insert_id");
$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$insert_id";
$customers_insert_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$customers_insert_output_response");

print $customers_insert_output_response;
?>