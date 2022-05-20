<?php

require __DIR__ . '/vendor/autoload.php';

//Establish connection with MongoDB
$mongoClient = (new MongoDB\Client);

//Name of database
$db = $mongoClient->ecommerce;

//Input recived
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);

//Criteria to find product to update
$findCriteria = [

    "_id" => new MongoDB\BSON\ObjectID($id)

];

//Find product based on criteria
$cursor = $db->fruits->find($findCriteria);

//Output product new details
foreach ($cursor as $fruit){

    echo '<table style="width:100%">';

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Description</th>';
        echo '<th>Keywords</th>';
        echo '<th>Image</th>';
        echo '<th>Net contents</th>';
        echo '<th>Price</th>';
        echo '<th>Stock count</th>';
        echo '</tr>';

            echo '<tr>';
    
                echo '<td>' . $fruit['_id'] . '</td>';

                echo '<td>' . $fruit['name'] . '</td>';

                echo '<td>' . $fruit['description'] . '</td>';

                echo '<td>' . $fruit['keywords'] . '</td>';

                echo '<td>' . $fruit['image_url'] . '</td>';

                echo '<td>' . $fruit['contents'] . '</td>';

                echo '<td>' . $fruit['price'] . '</td>';

                echo '<td>' . $fruit['quantity'] . '</td>';
    
        echo '</tr>';

    echo '</table>';

}

?>







                




