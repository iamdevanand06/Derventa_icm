<?php
require_once 'connect.php';
if ($_SERVER["REQUEST_METHOD"] === 'GET')
{
  if (isset($_REQUEST["username"]) && isset($_REQUEST["password"]))
  {
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    

    $sql = "SELECT name,username  FROM ad_user WHERE username = '" . $username . "' and password = '". $password ."'";

    $result = pg_query($dbconn, $sql);
    if(!$result)
    {
      echo pg_last_error($dbconn);
    } 
    else
    {

    $arr = pg_fetch_all($result);

    echo json_encode($arr);
    echo "{\"response\" : \"Login successfully.\"}";
    }
  }
  else
  {
    echo "{\"response\" : \"Enter The Valid Input!\"}";
  }
  // Close the connection
  pg_close($dbconn);
}
else
{
  echo "{\"response\" : \"Fix The Corresponding Service Method!\"}";
}

