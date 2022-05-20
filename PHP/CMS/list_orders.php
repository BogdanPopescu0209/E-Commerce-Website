<?php

require __DIR__ . '/vendor/autoload.php';

//Establish connection with MongoDB
$mongoClient = (new MongoDB\Client);

//Name of database
$db = $mongoClient->ecommerce;

//Find all orders from database
$cursor = $db->orders->find();

//Output table of products
echo '<table style="width:100%">';

echo '<tr>';
echo '<th>Order ID</th>';
echo '<th>Full name</th>';
echo '<th>Username</th>';
echo '<th>Shipping address</th>';
echo '<th>Date</th>';
echo '<th>Time</th>';
echo '<th>Products name</th>';
echo '<th>Products total quantity</th>';
echo '<th>Products total price</th>';
echo '</tr>';

foreach ($cursor as $order){

    echo '<tr>';

        echo '<td>' . $order['_id'] . '</td>';

        echo '<td>' . $order['email'] . '</td>';

        echo '<td>' . $order['full_name'] . '</td>';

        echo '<td>' . $order['address'] . '</td>';

        echo '<td>' . $order['date'] . '</td>';

        echo '<td>' . $order['time'] . '</td>';

        echo '<td>';

            //Output array
            foreach ($order['product_name'] as $custOrder){

                echo $custOrder ."; ";

            }

        '</td>';

        echo '<td>' . $order['total_quantity'] . '</td>';

        echo '<td>' ."£" . $order['total_price'] . '</td>';

    echo '</tr>';

}

echo '</table>';

?>
                   
                   
      

