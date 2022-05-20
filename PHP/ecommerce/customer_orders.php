<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//Check if user is logged in
if( array_key_exists('loggedInUser', $_SESSION)){

    //Take cusomer id from session
    $id = $_SESSION['loggedInUser'];

    //Search criteria
    $findEmailCriteria = [

    "_id" => $id
    
    ];

    //Search for the id for customer
    $result = $db->customers->find($findEmailCriteria);

    //Save customer email
    foreach($result as $customer){

        $email = $customer['email'];

    }

    //Search criteria
    $findCriteria = [

        "email" => $email
    
    ];

    //Search for order based on criteria
    $cursor = $db->orders->find($findCriteria);

    //Curosr to output content of array
    $cursor2 = $db->orders->find($findCriteria);

    echo '<table style="width:100%">';

        echo '<tr>';
            echo '<th>Order ID</th>';
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

} else {

    //If user not logged in output feedback
    echo 'Please log in to view order history!';
}

?>
                   