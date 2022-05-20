<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Take input from customer
$telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_STRING);

//Check if customer logged in
if( array_key_exists('loggedInUser', $_SESSION) ){

    $id = $_SESSION['loggedInUser'];
}

//Search criteria
$findCriteria = [

    "_id" => $id
];

//Udpate criteria
$updateData = [

    '$set' =>  ["telephone" => $telephone]
];

//Update product based on criteria
$updateProduct = $db->customers->updateOne($findCriteria, $updateData);

//WHen detail updated redirect to page
if($updateProduct->getModifiedCount() == 1){

    header('Location: /HTML/ecommerce/account.html');

}

?>