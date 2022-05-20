<?php

require __DIR__ . '/vendor/autoload.php';

//Establish connection to MongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Collection
$collection = $db->customers;

//Recive input values from customer
$full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//Data array contains customer infortmation
$dataArray = [
    "full_name" => $full_name,
    "email" => $email,
    "address" => $address,
    "telephone" => $telephone,
    "password" => $password,
];

//Insert array into database
$insertResult = $collection->insertOne($dataArray);

//Output feedback
if($insertResult->getInsertedCount() == 1){
    
    echo 'Registration successful!';
    
    } else {
    
    echo 'Error durring registration!';
}

?>
