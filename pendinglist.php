<?php 
	if(isset($_GET['PHPSESSID'])){
    session_id($_GET['PHPSESSID']);
    session_start();
        require_once 'connect.php';
    if ($_SERVER["REQUEST_METHOD"] === 'GET')
    {
        $pending = pg_query($dbconn, "SELECT D.rchr_approvalhistrory_id, B.name, B.description, D.created FROM ad_org B INNER JOIN rchr_approvalhistrory D ON B.ad_org_id=D.ad_org_id WHERE D.decision='PE'");
        if (!$pending) 
        {
            echo "An error occurred.\n";
            exit;
        }
        elseif($pending)
        {
          $arrp = pg_fetch_all($pending);
          header("Content-type:application/json");
          $jarrp= json_encode($arrp);
          header("HTTP/1.1 200");
          echo $jarrp;
          
        }
        else
        {
          header("HTTP/1.1 400");
          echo"{\"response\" : \"Enter The Valid Input!\"}";
        }
        
    }
    else
    {
      header("HTTP/1.1 400");
      echo "{\"response\" : \"Fix The Corresponding Service Method!\"}";
    } 
  }else {
      //session is not set
      // return 401
      header("HTTP/1.1 401");
      echo"{\"response\" : \"Invalid session\"}";
  }
// } else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
//   //session is not set
//   // return 401
// }