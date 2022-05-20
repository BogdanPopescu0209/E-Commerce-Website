<?php

//Start session
session_start();

//Clear out session variabels
session_unset(); 

//Destroy session
session_destroy(); 

header("Location: /HTML/CMS/cms_home.html");

?>
    