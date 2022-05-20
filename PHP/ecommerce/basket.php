<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDB
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//If user logged in execute function if not output feedback
if( array_key_exists('loggedInUser', $_SESSION) ){

    //Take id for customer
    $customerId = $_SESSION['loggedInUser'];

    //Criteria to check customer id
    $findCriteria = [

        "_id" => $customerId
    ];

    //Store result into array
    $findCustomerEmail = $db->customers->find($findCriteria)->toArray();

    //Store email
    for ($i=0; $i < count($findCustomerEmail); $i++) { 
        
        $email = $findCustomerEmail[$i]['email'];
    }

    //Search criteria
    $orderCriteria = [

        'email' => $email
    ];

    //Find all products from the basket collection from the same customer
    $cursor = $db->basket->find($orderCriteria);

    //Total price
    $totalPrice = 0;

    //Output basket 
    echo '<table>';

        foreach ($cursor as $fruit){

            echo '<tr>';

                echo '<td>' . $fruit['image_url'] . '</td>';

                echo '<td>' . $fruit['name'] . '</td>';

                echo '<td>' ."Quantity: ". $fruit['quantity'] . '</td>';

                $price = $fruit['price'];
                $quantity = $fruit['quantity'];
                $total = $price * $quantity;
                $totalPrice += $price * $quantity;

                echo '<td>' ."Total price: £". $total . '</td>';

                echo '<td>';

                    //Delete product from basket
                    echo '<form action="/PHP/ecommerce/delete.php" method="POST">';

                        echo '<button class="add" name="id" type="submit" value="'.$fruit['product_id'].'">Delete</button>';

                    echo '</form>';

                echo '</td>';

            echo '</tr>';

        }

    echo '</table>';

                //Checkout
                echo '<form action="/PHP/ecommerce/checkout.php" method="POST">';

                    echo '<button class="add" name="total_price" type="submit" value="'.$totalPrice.'">Place order</button>';

                echo '</form>';

} else {

    //Output feedback if customer not logged in
    echo 'Please log in to buy your favorite fruits!';
}

?>
