<?php

//Start session
session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Store results in array
$checkBasket =$db->basket->find()->toArray();

//If basket not empty execute function  
if (count($checkBasket) != 0 ){

    //Take input for total price
    $total_price = filter_input(INPUT_POST, 'total_price', FILTER_SANITIZE_STRING);

    //Take customer id from session storage
    $customerId =  $customerId = $_SESSION['loggedInUser'];

    //Search criteria
    $findCriteria = [

        "_id" => $customerId

    ];

    //Search form customer details and store in array
    $findCustomerDetails = $db->customers->find($findCriteria)->toArray();

    //Store customers email and address
    for ($i=0; $i < count($findCustomerDetails); $i++) { 
        
        $email = $findCustomerDetails[$i]['email'];
        $address = $findCustomerDetails[$i]['address'];
        $customerName = $findCustomerDetails[$i]['full_name'];
    }

    //Search criteria
    $orderCriteria = [

        'email' => $email

    ];

    //Find all open basket orders with the same email
    $cursor = $db->basket->find($orderCriteria);

    //Find product details
    foreach ($cursor as $fruit){

        $productId[] = $fruit['product_id'];
        $quantity[] = $fruit['quantity'];
        $name[] = $fruit['name'];
    }

    //Total quantity of products
    $total_quantity = array_sum($quantity);


    //Output product id
    for ($i=0; $i < count($productId); $i++) { 
   
        $productId[$i];

    }

    //Date and time when order was placed
    $date = date("Y-m-d");
    date_default_timezone_set('Europe/London');
    $time = date("h:i:sa");

    //Order details to be store in the database
    $dataArray = [
        "email" => $email,
        "full_name" => $customerName,
        "address" => $address,
        "date" => $date,
        "time" => $time,
        "product_name" => $name,
        "products_id" => $productId,
        "quantity" => $quantity,
        "total_quantity" => $total_quantity,
        "total_price" =>$total_price
    ];

    //Send order to the database
    $insertResult = $db->orders->insertOne($dataArray);

    //If order was succesfully placed output feedback
    if($insertResult->getInsertedCount() == 1){
    
    //Delete existing orders from basket
    $db->basket->deleteMany($orderCriteria);

    header("Location: /HTML/ecommerce/checkout.html");
        
    }

} else 

    header("Location: /HTML/ecommerce/fruit.html");

?>
