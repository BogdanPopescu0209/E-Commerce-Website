<?php

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDb
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Take input from basket
$fruitID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//Delete criteria
$deleteCriteria = [

    "product_id" => $fruitID
];

//Find product and delete from basket
$deleteProduct = $db->basket->deleteOne($deleteCriteria);

//If product delete redirect to page
if($deleteProduct->getDeletedCount() == 1){

    header("Location: /HTML/ecommerce/basket.html");

}

?>

