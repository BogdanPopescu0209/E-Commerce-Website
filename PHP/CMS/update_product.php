<?php

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Recive input
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_STRING);
$keywords = filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING);
$contents = filter_input(INPUT_POST, 'contents', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);

//Search criteria
$findCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($id)
];

//New details
$updateData = [
    '$set' =>  ["name" => $name,
                "description" => $description,
                "image_url" => $image_url,
                "keywords" => $keywords,
                "contents" => $contents,
                "price" => $price,
                "quantity" => $quantity]
];

//Update product based on the search criteria
$updateProduct = $db->fruits->updateOne($findCriteria, $updateData);

//If updated output feedback or error if not
if($updateProduct->getModifiedCount() == 1){

    echo 'Product document succesfully updated.';

} else {

    echo 'Product update error.';

}

?>