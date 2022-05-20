<?php

//Start session
session_start();

//Recive input values from customer
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

require __DIR__ . '/vendor/autoload.php';

//Establish connection with mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Find criteria to find customer details
$findCriteria = [ 
    
    "email" => $email,
    "password" => $password
];

//Array with the customer details
$resultArray = $db->customers->find($findCriteria)->toArray();

//If array emptu output feedback
if(count($resultArray) === 0){

    echo "Wrong username or password!";
}

//Check if details match and output details
for ($i=0; $i < count($resultArray); $i++) { 
    
    if($email === $resultArray[$i]['email'] && $password === $resultArray[$i]['password']){

        echo 'Welcome!';
        $_SESSION['loggedInUser'] = $resultArray[$i]['_id'];
    
    }
}

?>

                    







