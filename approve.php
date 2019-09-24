<?php
session_id($_REQUEST['PHPSESSID']);
  session_start();
  require_once 'connect.php';
  if(isset($_REQUEST['PHPSESSID'])){
  // if(session_status() === PHP_SESSION_ACTIVE)
  //   {
        //session is set
    
      if ($_SERVER["REQUEST_METHOD"] === 'OPTIONS')
      {
        if (isset($_REQUEST["rchr_approvalhistrory_id"]))
        {
          $rchr_approvalhistrory_id = $_REQUEST["rchr_approvalhistrory_id"];

          $decision = "APR";

          $sql = "UPDATE rchr_approvalhistrory SET decision ='$decision', updated=NOW(), reason= NULL WHERE rchr_approvalhistrory_id = '$rchr_approvalhistrory_id'";

          $result = pg_query($dbconn, $sql);
          if(!$result)
          {
            echo pg_last_error($dbconn);
          } 
          else
          {
            header("HTTP/1.1 200");
            echo "{\"response\" : \"Updated successfully.\"}";
          }
        }
        else
        {
          header("HTTP/1.1 400");
          echo "{\"response\" : \"Enter The Valid Input!\"}";
        }
        // Close the connection
        pg_close($dbconn);
      }
      else
      {
        header("HTTP/1.1 400");
        echo "{\"response\" : \"Fix The Corresponding Service Method!\"}";
      }
    } else {
      //session is not set
      // return 401
      header("HTTP/1.1 401");
      echo"{\"response\" : \"Invalid session\"}";
  }


