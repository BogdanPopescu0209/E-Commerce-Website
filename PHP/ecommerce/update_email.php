<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDb
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Take input from customer
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

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

    '$set' =>  ["email" => $email]
];

//Update product based on criteria
$updateProduct = $db->customers->updateOne($findCriteria, $updateData);

//When product updated redirect to page
if($updateProduct->getModifiedCount() == 1){

    header('Location: /HTML/ecommerce/account.html');

}

?>