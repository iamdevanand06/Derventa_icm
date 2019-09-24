<?php

require_once 'connect.php';


session_start();

if ($_SERVER["REQUEST_METHOD"] === 'GET')
{

$user = $_GET['username'];
$password = $_GET['password'];

if((!$user) || (!$password)){
    header("HTTP/1.1 400");
    echo "{\"response\" : \"Enter Username and Password\"}";
    
}else{
    // $password = md5($password);
    
    $sql = pg_query("SELECT * FROM ad_user WHERE username = '{$user}' AND password = '{$password}'");
    
    $login_check = pg_num_rows($sql);
    
    if($login_check > 0){
        
        while($row = pg_fetch_array($sql)){
            foreach ($row as $key => $val){
                $$key = stripslashes( $val );
            }

            // $_SESSION['logged_in'] = true;
            $_SESSION['ad_user_id'] = $ad_user_id;
            $_SESSION['user'] = $user;
            $_SESSION['username'] = $username;

            $currentCookieParams = session_get_cookie_params();  
            $sidvalue = session_id();
            
            setcookie(  
                'PHPSESSID',//name  
                $sidvalue,//value  
                3600,//expires at end of session  
                $currentCookieParams['path'],//path  
                $currentCookieParams['domain'],//domain  
                false, //secure 
                false // httponly
            );
            header("Content-type:application/json");
            $ssid=json_encode($sidvalue);
            $ssidp='[{"PHPSESSID":"'.$sidvalue.'"}]';
            echo $ssidp;
        }
    }else{
        header("HTTP/1.1 400");
        echo "{\"response\" : \"Invalid Username and Password\"}";
    }
}
}
else{
    header("HTTP/1.1 400");
    echo "{\"response\" : \"Fix the Correspoding Method!\"}";
}

?>