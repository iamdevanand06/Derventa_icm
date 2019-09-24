<?php
session_id($_GET['PHPSESSID']);
session_start();
require_once 'connect.php';
if(isset($_GET['PHPSESSID'])){
if ($_SERVER["REQUEST_METHOD"] === 'PUT')
{
  if (isset($_REQUEST["rchr_approvalhistrory_id"]))
  {
    $rchr_approvalhistrory_id = $_REQUEST["rchr_approvalhistrory_id"];

    $decision = "APR";

    $sql = "UPDATE rchr_approvalhistrory SET decision ='PE', reason= NULL WHERE rchr_approvalhistrory_id = '$rchr_approvalhistrory_id'";

    $result = pg_query($dbconn, $sql);
    if(!$result)
    {
      echo pg_last_error($dbconn);
    } 
    else
    {
      header("HTTP/1.1 200");
      echo "{\"response\" : \"Updated successfully\"}";
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
  echo "{\"response\" : \"Method Not Matched!\"}";
}
}else{
  header("HTTP/1.1 401");
  echo"{\"response\" : \"Invalid session\"}";
}

