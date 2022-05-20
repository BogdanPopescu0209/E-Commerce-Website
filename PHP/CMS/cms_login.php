<?php

//Start session
session_start();

require __DIR__ . '/vendor/autoload.php';

$mongoClient = (new MongoDB\Client);

//Establish connection with MongoDB
$db = $mongoClient->ecommerce;

//Input recived
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//Criteria to find employee
$findCriteria = [ 
    
    "username" => $username,
    "password" => $password
];

//Find customer and store in array
$resultArray = $db->employee->find($findCriteria)->toArray();

//If array is empty output feedback
if(count($resultArray) === 0){

    echo '
  
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Link to external file bootstrap-->
        <link rel="stylesheet" href="/Bootstrap/bootstrap.min.css">
        <!--Link to external file style sheet-->
        <link rel="stylesheet" href="/CSS/style_cms.css">
        <!--Link to external JavaScript-->
        <script src="/JavaScript/CMS/login.js"></script>
    </head>
    
    <body>
    
        <div class="container-fluid">
    
            <br>
            <br>
            <br>
    
            <!--Row-->
            <div class="container-fluid">
                <div class="row">
    
                    <!--Left column-->
                    <div class="col-lg"></div>
    
                    <!--Middle column-->
                    <div class="col-lg">
    
                        <!--Login form-->
                        <h1>Content Management System</h1><br><br>
    
                        <form action="/PHP/CMS/cms_login.php" method="post">
                            <input type="text" name="username" placeholder="Username:"><br><br>
                            <input type="text" name="password" placeholder="Password:"><br><br>
                            <button class="login">Log In</button>
                        </form>
    
                        <br>
                        <br>
    
                        <p>
                            <!--Server response-->
                            <span id="ServerFeedbackLogin"></span>

                           '; echo 'Wrong username or password!

                        </p>
    
                    </div>
    
                    <!--Right column-->
                    <div class="col-lg"></div>
    
                </div>
    
            </div>
    
        </div>
    
    </body>
    
    </html>';
    
}

//Check if input matches details from array
for ($i=0; $i < count($resultArray); $i++) { 
    
    if($username === $resultArray[$i]['username'] && $password === $resultArray[$i]['password']){

        echo "Welcome!";
        header("Location: /HTML/CMS/cms_add.html");
        $_SESSION['loggedInUser'] = $resultArray[$i]['_id'];
        
    }
}

?>





