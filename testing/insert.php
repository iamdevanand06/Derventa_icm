<?php
session_start();
require_once 'connect.php';
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            //session is set
if ($_SERVER["REQUEST_METHOD"] === 'POST')
{
  if (isset($_REQUEST["ad_dimension_id"]) && isset($_REQUEST["isactive"]) && isset($_REQUEST["ad_client_id"]) && isset($_REQUEST["ad_org_id"]) && isset($_REQUEST["created"]) && isset($_REQUEST["createdby"]) && 
  isset($_REQUEST["updated"]) && isset($_REQUEST["updatedby"]) && isset($_REQUEST["columnname"]) && isset($_REQUEST["line"]) && isset($_REQUEST["description"]) && 
  isset($_REQUEST["join_group1"]) && isset($_REQUEST["tablename"]) && isset($_REQUEST["join_group2"]))
  {
    $ad_dimension_id = $_REQUEST["ad_dimension_id"];
    $ad_client_id = $_REQUEST["ad_client_id"];
    $ad_org_id = $_REQUEST["ad_org_id"];
    $isactive = $_REQUEST["isactive"];
    $created = $_REQUEST["created"];
    $createdby = $_REQUEST["createdby"];
    $updated = $_REQUEST["updated"];
    $updatedby = $_REQUEST["updatedby"];
    $columnname = $_REQUEST["columnname"];
    $line = $_REQUEST["line"];
    $description = $_REQUEST["description"];
    $join_group1 = $_REQUEST["join_group1"];
    $tablename = $_REQUEST["tablename"];
    $join_group2 = $_REQUEST["join_group2"];
    

    $sql = "INSERT INTO ad_dimension (ad_dimension_id,ad_client_id,ad_org_id,isactive,created,createdby,updated,updatedby,columnname,line,description,join_group1,tablename,join_group2) 
    VALUES ('$ad_dimension_id', '$ad_client_id', '$ad_org_id', '$isactive', '$created', '$createdby', '$updated', '$updatedby', '$columnname', '$line', '$description', '$join_group1', '$tablename', '$join_group2');";

    $result = pg_query($dbconn, $sql);

    if(!$result)
    {
      echo pg_last_error($dbconn);
    }
    else
    {
      echo "Insert successfully";
    }

    // Close the connection
    pg_close($dbconn);
  }
  else
  {
    echo "Enter The Valid Input";
  }
}
else
{
  echo "Fix The Corresponding Service Method!";
}
} else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
  //session is not set
  // return 401
}
?>