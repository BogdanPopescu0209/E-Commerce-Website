<?php

require __DIR__ . '/vendor/autoload.php';

//Establish connection with MongoDB
$mongoClient = (new MongoDB\Client);

//Name of database
$db = $mongoClient->ecommerce;

//Input recived
$fruitID = filter_input(INPUT_POST, 'idItem', FILTER_SANITIZE_STRING);

//Criteria to find order to delete
$deleteCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($fruitID)
];

//Delete product
$deleteProduct = $db->fruits->deleteOne($deleteCriteria);

//Output feedback it product was deleted
if($deleteProduct->getDeletedCount() == 1){

     echo 'Product deleted successfully.';

}
    else {

    echo 'Error deleting product.';

}

?>

                   
