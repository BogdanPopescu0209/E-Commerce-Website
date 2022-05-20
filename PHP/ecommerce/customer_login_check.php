<?php

session_start();
    
if( array_key_exists('loggedInUser', $_SESSION) ){

    echo "ok";
}
else{
    
    echo 'Please log in to buy your favorite fruits!';
}

