<?php
// Updates the details of a customer, through the `customers` table in database `bookstore`. Takes in input the details to be updated and outputs a JSON with response code and update id.

// **REQUIRES**
// A JSON object named "customers_update_input_query" must be POSTed to this file with the following key-value pairs:
 
// customers_update_input_query = 
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
//         key: "addessLine1"
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

//     }

// **ENSURES**
// a row is updated in the customers table in the database with the passed attributes.
// A JSON response is outputted, "customers_update_output_response" which is formed as:

// customers_update_output_response = 
//     {  
//         "response_code": <RESPONSE CODE>,
//         "response": "null"
//     }


// DEBUGGING TOOL - COMMENT OUT LATER - TO DO! 🔲
include "../../../debug/chromephp-master/ChromePhp.php";

require "../../../internal/dbconnect.php";
session_start();

$sql = "UPDATE `customers` SET `email`=?,`firstName`=?,`lastName`=?,`postalCode`=?,`street`=?,`addessLine1`=?,`addressLine2`=?,`city`=?,`country`=?,`phone`=?,`username`=?,`passwordencrypted`=?,`isAdmin`=?,`emailVerified`=?,`phoneVerified`=?,`lastOnline`=?, `referralCode`=?,`referredBy`=?,`dataStoragePermission`=?,`dob`=? WHERE id=?";


// log to console
ChromePhp::log($sql);

// decode the JSON POSTed variable
$update_input_query_encoded = $_REQUEST["customers_update_input_query"];
$update_input_query = json_decode($update_input_query_encoded);


// Parse the POST-ed JSON input object into individual attributes

$id = number_format($update_input_query->id);
ChromePhp::log("\nid=$id");

$email = $update_input_query->email;
ChromePhp::log("\nemail=$email");

$firstName = $update_input_query->firstName;
ChromePhp::log("\nfirstName=$firstName");

$lastName = $update_input_query->lastName;
ChromePhp::log("\nlastName=$lastName");

$postalCode = number_format($update_input_query->postalCode);
ChromePhp::log("\npostalCode=$postalCode");

$street = $update_input_query->street;
ChromePhp::log("\nstreet=$street");

$addessLine1 = $update_input_query->addessLine1;
ChromePhp::log("\naddressLine1=$addessLine1");

$addressLine2 = $update_input_query->addressLine2;
ChromePhp::log("\naddressLine2=$addressLine2");

$city = $update_input_query->city;
ChromePhp::log("\ncity=$city");

$country = $update_input_query->country;
ChromePhp::log("\ncountry=$country");

$phone = $update_input_query->phone;
ChromePhp::log("\nphone=$phone");

$username = $update_input_query->username;
ChromePhp::log("\nusername=$username");

$passwordencrypted = $update_input_query->passwordencrypted;
ChromePhp::log("\npasswordencrypted=$passwordencrypted");

$isAdmin = number_format($update_input_query->isAdmin);
ChromePhp::log("\nisAdmin=$isAdmin");

$emailVerified = number_format($update_input_query->emailVerified);
ChromePhp::log("\nemailVerified=$emailVerified");

$phoneVerified = number_format($update_input_query->phoneVerified);
ChromePhp::log("\nphoneVerified=$phoneVerified");

//$registrationDate = $_update_input_query->registrationDate;
//ChromePhp::log("\nregistartionDate=$registrationDate");

$lastOnline = $update_input_query->lastOnline;
ChromePhp::log("\nlastOnline=$lastOnline");

$referralCode = $update_input_query->referralCode;
ChromePhp::log("\nreferralCode =$referralCode");

$referredBy = $update_input_query->referredBy;
ChromePhp::log("\nreferredBy =$referredBy");

$dataStoragePermission = number_format($update_input_query->dataStoragePermission);
ChromePhp::log("\ndataStoragePermission =$dataStoragePermission ");

$dob = $update_input_query->dob;
ChromePhp::log("\ndob =$dob");

// prepares the SQL statement
$stmt = $mysqli->prepare($sql);

ChromePhp::log("Query Prepared");


// checks for errors
if(! $stmt) 
{	
    echo "ERROR:: ".$mysqli->error;
}

// binds parameters to their respective datatypes in the database

$stmt->bind_param("sssissssssssiiisssisi", $email, $firstName, $lastName, $postalCode, $street, $addessLine1, $addressLine2, $city, $country, $phone, $username, $passwordencrypted, $isAdmin, $emailVerified, $phoneVerified, $lastOnline, $referralCode, $referredBy, $dataStoragePermission, $dob, $id);

ChromePhp::log("Parameters Bound");

// executes statement
$stmt->execute();


ChromePhp::log("SQL Executed");

// get the id of the update
$updated_rows = "null";

// REMOVE - TO DO 🔲
ChromePhp::log("Updated customer: customers_id=$updated_rows");

$response = json_decode("{}");
$response->response_code = $stmt->error;
if ($stmt->error == "")
{
    $response->response_code = "success";
}

$response->response = "$updated_rows";
$customers_update_output_response = json_encode($response);

// REMOVE - TO DO 🔲
ChromePhp::log("\nComponent Output Response=$customers_update_output_response");

print $customers_update_output_response;
?>