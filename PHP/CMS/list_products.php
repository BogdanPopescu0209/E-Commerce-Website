<?php

require __DIR__ . '/vendor/autoload.php';

//Establish connection with MongoDB
$mongoClient = (new MongoDB\Client);

//Name of database
$db = $mongoClient->ecommerce;

//Find all products from database
$cursor = $db->fruits->find();

//Output table of products
echo '<table style="width:100%">';

    echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Description</th>';
        echo '<th>Keywords</th>';
        echo '<th>Image_URL</th>';
        echo '<th>Net contents</th>';
        echo '<th>Price</th>';
        echo '<th>Stock count</th>';
    echo '</tr>';

    foreach ($cursor as $fruit){

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

    }

echo '</table>';

?>
                    
     