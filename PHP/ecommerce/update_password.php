<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Recive input from customer
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

//Check if customer logged in
if( array_key_exists('loggedInUser', $_SESSION) ){

    $id = $_SESSION['loggedInUser'];
}

//Search criteria
$findCriteria = [

    "_id" => $id
];

//UPdate criteria
$updateData = [

    '$set' =>  ["password" => $password]
];

//Update based on criteria
$updateProduct = $db->customers->updateOne($findCriteria, $updateData);

//When detail updated redirect to page
if($updateProduct->getModifiedCount() == 1){

    header('Location: /HTML/ecommerce/account.html');

}

?>