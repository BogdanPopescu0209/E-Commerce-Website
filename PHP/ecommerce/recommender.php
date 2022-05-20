<?php

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Input from customer
$name = filter_input(INPUT_POST, "search" , FILTER_SANITIZE_STRING);

//Criteria to search for product
$findCriteria = [

    '$text' => ['$search' => $name] 
];

//Search for product
$cursor = $db->fruits->find($findCriteria);

//Output result
echo '<table>';

    foreach ($cursor as $fruit){

        echo '<tr>';

            echo '<td>' . $fruit['image_url'] . '</td>';

                echo '<td>' . $fruit['name'] . '</td>';

            echo '<td>';

                //Add product to basket
                echo '<form action="/PHP/ecommerce/add_to_basket.php" method="POST">';

                    echo '<button class="add" name="id" type="submit" value="'.$fruit["_id"].'">+</button>';

                echo '</form>';

                    //Remove product from basket
                    echo '<form action="/PHP/ecommerce/remove_from_basket.php" method="POST">';

                    echo '<button class="add" name="id" type="submit" value="'.$fruit["_id"].'">-</button>';

                echo '</form>';
   
            echo '</td>';

            echo '<td>' ."Contents: ". $fruit['contents'] . '</td>';

            echo '<td>' ."Price £ ". $fruit['price'] . '</td>';

            echo '<td>' . $fruit['description'] . '</td>';

        echo '</tr>';

    }

echo '</table>';

?>



