<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongo DB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Take input from customer
$address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);

//Check if customer is loged in and store id
if( array_key_exists('loggedInUser', $_SESSION) ){

    $id = $_SESSION['loggedInUser'];
}

//Search criteria
$findCriteria = [

    "_id" => $id
];

//Update criteria
$updateData = [

    '$set' =>  ["address" => $address]
];

//Update detail
$updateProduct = $db->customers->updateOne($findCriteria, $updateData);

//When detail updated redirect to page
if($updateProduct->getModifiedCount() == 1){

    header('Location: /HTML/ecommerce/account.html');

}

?>