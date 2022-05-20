<?php

require __DIR__ . '/vendor/autoload.php';

//Establish connection with MongoDB
$mongoClient = (new MongoDB\Client);

//Name of database
$db = $mongoClient->ecommerce;

//Input recived
$orderID = filter_input(INPUT_POST, 'idOrder', FILTER_SANITIZE_STRING);

//Criteria to find order to delete
$deleteCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($orderID)
];

//Delete order
$deleteOrder = $db->orders->deleteOne($deleteCriteria);

//Output feedback if order was deleted
if($deleteOrder->getDeletedCount() == 1){

    echo 'Order deleted successfully.';

    }

    else {

        echo 'Error deleting order.';

}

?>



  
