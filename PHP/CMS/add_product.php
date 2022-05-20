<?php

require __DIR__ . '/vendor/autoload.php';

//Establish connection with MongoDB
$mongoClient = (new MongoDB\Client);

//Name of database
$db = $mongoClient->ecommerce;

//Name of collection
$collection = $db->fruits;

//Input recived
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$keywords = filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING);
$contents = filter_input(INPUT_POST, 'contents', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);

//Image for product
$uploadFileName = $_FILES["imageToUpload"]["name"];

//Place to store image
$target_file = 'images/' . $uploadFileName;

//Upload image and store
move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file);

//Array of details to send to server
$dataArray = [
    "name" => $name,
    "description" => $description,
    "keywords" => $keywords,
    "image_url" => $target_file,
    "contents" => $contents,
    "price" => $price,
    "quantity" => $quantity
];

//Send array to server
$insertResult = $collection->insertOne($dataArray);

if($insertResult->getInsertedCount() == 1){
    
    header("Location: /HTML/CMS/cms_list.html");

}

?>







