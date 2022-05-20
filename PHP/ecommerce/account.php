<?php

//Start session
session_start();

require __DIR__ . '/vendor/autoload.php';

//Connect to mongoDb
$mongoClient = (new MongoDB\Client);

//Database
$db = $mongoClient->ecommerce;

//If user logged in execute function if not output feedback
if( array_key_exists('loggedInUser', $_SESSION) ){

    //Take id from session storage
    $id = $_SESSION['loggedInUser'];

    //Search criteria
    $findCriteria = [

        "_id" => $id

    ];

    //Search for criteria 
    $cursor = $db->customers->find($findCriteria);

    //Output user details
    foreach ($cursor as $user){


        echo '<br>';
        echo '<br>';
        echo '<br>';

        echo '<table style="width:100%">';

        echo '<tr>';
    
                echo '<td>' . $user['full_name'] . '</td>';

                echo '<td>' . $user['email'] . '</td>';

                echo '<td>' . $user['address'] . '</td>';

                echo '<td>' . $user['telephone'] . '</td>';

                echo '<td>' . $user['password'] . '</td>';

        echo '</tr>';

        echo '<tr>';

            //Update customer name form
            echo '<td>
            
                <form action="/PHP/ecommerce/update_name.php" method="POST">
                    <input type="text" name="full_name" placeholder="Full Name" required>
                    <button class="add">Update Name</button>
                </form>
            
            </td>';

            //Update customer email form
            echo '<td>
            
                <form action="/PHP/ecommerce/update_email.php" method="POST">
                    <input type="text" name="email" placeholder="Email" required>
                    <button class="add">Update Email</button>
                </form>
            
            </td>';
            
            //Update customer address form
            echo '<td>

                <form action="/PHP/ecommerce/update_address.php" method="POST">
                    <input type="text" name="address" placeholder="Address" required>
                    <button class="add">Update Address</button>
                </form>
                    
            </td>';

            //Update customer telephone form
            echo '<td>

                <form action="/PHP/ecommerce/update_telephone.php" method="POST">
                    <input type="text" name="telephone" placeholder="Telephone" required>
                    <button class="add">Update Telephone</button>
                </form>
        
            </td>';
            
            //Update customer password formß
            echo '<td>

                <form action="/PHP/ecommerce/update_password.php" method="POST">
                    <input type="text" name="password" placeholder="Password" required>
                    <button class="add" onclick="">Update Password</button>
                </form>
                
            </td>';
    
        echo '</tr>';

    echo '</table>';

    }

} else {

    //Output feedback if customer not logged in
    echo 'Please log in to acces user details!';
}

?>
