<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Take input from customer
$full_name = filter_input(INPUT_POST, "full_name", FILTER_SANITIZE_STRING);

//Check if customer is logged in and store id
if( array_key_exists('loggedInUser', $_SESSION) ){

    $id = $_SESSION['loggedInUser'];
}

//Search criteria
$findCriteria = [

    "_id" => $id
];

//Update criteria
$updateData = [

    '$set' =>  ["full_name" => $full_name]
];

//Update detail based on the criteria
$updateProduct = $db->customers->updateOne($findCriteria, $updateData);

//When detail updated redirect to page
if($updateProduct->getModifiedCount() == 1){

    header('Location: /HTML/ecommerce/account.html');

}

?>