<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

$mongoClient = (new MongoDB\Client);

$db = $mongoClient->ecommerce;

$collection = $db->basket;

if( array_key_exists('loggedInUser', $_SESSION) ){

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

    $customerId = $_SESSION['loggedInUser'];
    
    //Criteria to find customer email
    $findCriteria = [

        "_id" => $customerId
    ];

    $findCustomerEmail = $db->customers->find($findCriteria)->toArray();

    //Get customer email
    for ($i=0; $i < count($findCustomerEmail); $i++) { 
        
        $email = $findCustomerEmail[$i]['email'];
    }

    $quantity = 1;

    //Extract fruit details
    $findProductCriteria = [

        "_id" => new MongoDB\BSON\ObjectID($id)
    ];

    $productArray = $db->fruits->find($findProductCriteria)->toArray();

    foreach($productArray as $fruit){

        $name = $fruit['name'];
        $image_url= $fruit['image_url'];
        $contents =$fruit['contents'];
        $price = $fruit['price'];
    }

    //Details to insert into the new order
    $dataArray = [
        
        "email" => $email,
        "product_id" => $id,
        "quantity" => $quantity,
        "name" => $name,
        "image_url" => $image_url,
        "contents" => $contents,
        "price" => $price
    ];

    //Criteria to find existing order
    $findFruit = [

        "email" => $email,
        "product_id" => $id
    ];

    //Find product to update quantity
    $findProduct = $db->basket->find($findFruit);

    foreach($findProduct as $fruit){

        $oldQuantity = $fruit['quantity'];
    }

    //New quantity
    $newQuantity = $oldQuantity - 1;

    //New update detail
    $updateData = [

        '$set' => ['quantity' => $newQuantity]
    ];

    //Update quantity if the product is in the basket
    $updateProduct = $collection->updateOne($findFruit, $updateData);

    if($updateProduct->getModifiedCount() == 1){

        header("Location: /HTML/ecommerce/fruit.html");
        exit();
    }

    //Add new product to basket
    $insertResult = $collection->insertOne($dataArray);

    //When product inserted redirect to page
    if($insertResult->getInsertedCount() == 1){
    
        header("Location: /HTML/ecommerce/fruit.html");
        exit();
        
    }
    
    header("Location: /HTML/ecommerce/fruit.html");
    
} else

    //If user not logged in output feedback
    header("Location: /HTML/ecommerce/login.html");

    ?>