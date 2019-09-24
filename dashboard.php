<?php
// if(isset($_GET['PHPSESSID'])){
    // $dashco=$_GET["PHPSESSID"];
    session_id($_GET['PHPSESSID']);
    session_start();
    // if(session_status() === PHP_SESSION_ACTIVE)
    // {
        require_once 'connect.php';
    if(isset($_GET["PHPSESSID"])){
        // $value=$_GET['PHPSESSID'];
        // setcookie("PHPSESSID", "$value", time() + 8600, "/");
        //session is set
        if ($_SERVER["REQUEST_METHOD"] === 'GET')
        {
            $pending = pg_query($dbconn, "SELECT COUNT(*) As pending FROM rchr_approvalhistrory WHERE decision='PE'");
            if (!$pending) 
            {
                echo "An error occurred.\n";
                exit;
            }
            else{
                $arrp = pg_fetch_all($pending);
                header("Content-type:application/json");
                $jarrp= json_encode($arrp);
                header("HTTP/1.1 200");
                echo $jarrp;
            }
        } else {
            header("HTTP/1.1 400");
            echo "{\"response\" : \"Method Not Matched!\"}";
        }
    } else {
        //session is not set
        // return 401
        // check
        header("HTTP/1.1 401");
        echo"{\"response\" : \"Invalid session\"}";
    }

?>