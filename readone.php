<?php 
if(isset($_GET['PHPSESSID'])){
    session_id($_GET['PHPSESSID']);
session_start();
	require_once 'connect.php';
    //if(session_status() === PHP_SESSION_ACTIVE)
    // if(isset($_SESSION))
    // {
        //session is set

        if ($_SERVER["REQUEST_METHOD"] === 'GET')
        {
            if (isset($_REQUEST["rchr_approvalhistrory_id"]))
            //if(true)
            {
            $rchr_approvalhistrory_id = $_REQUEST["rchr_approvalhistrory_id"];

            $result = pg_query($dbconn, "SELECT D.rchr_approvalhistrory_id, D.created, B.name, B.description FROM ad_org B INNER JOIN rchr_approvalhistrory D ON B.ad_org_id=D.ad_org_id WHERE D.decision='PE' AND D.rchr_approvalhistrory_id='$rchr_approvalhistrory_id'");
                if (!$result)
                {
                    echo "An error occurred.\n";
                    exit;
                }

            $arr = pg_fetch_all($result);
            header("HTTP/1.1 200");
            echo json_encode($arr);
            }
            else
            {
                header("HTTP/1.1 400");
                echo "{\"response\" : \"Enter The Valid Input!\"}";
            }
        }
        else
        {
            header("HTTP/1.1 400");
            echo "{\"response\" : \"Fix The Corresponding Service Method!\"}";
        }
        //} else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
            //session is not set
            // return 401
        }
    else {
        //session is not set
        // return 401
        header("HTTP/1.1 401");
        echo"{\"response\" : \"Invalid session\"}";
    }
?>