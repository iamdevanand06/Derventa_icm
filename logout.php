<?php
// Always start this first
session_start();
require_once 'connect.php';
    if(session_status() === PHP_SESSION_ACTIVE)
    {

// Destroying the session clears the $_SESSION variable, thus "logging" the user
// out. This also happens automatically when the browser is closed
        //unset($_SESSION['PHPSESSID']);
        //$logout=session_status();
        session_destroy();
        header("HTTP/1.1 200");
        echo"{\"response\" : \"Logout Successfully!\"}";
    }else {
        //session is not set
        // return 401
        header("HTTP/1.1 401");
        echo"{\"response\" : \"Invalid session\"}";
    }
?>