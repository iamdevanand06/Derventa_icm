<?php

require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === 'DELETE')
{
  if (isset($_REQUEST["ad_dimension_id"]))
  {
    $ad_dimension_id = $_REQUEST["ad_dimension_id"];
    
    $sql = "DELETE FROM ad_dimension WHERE ad_dimension_id = '$ad_dimension_id'";

    $result = pg_query($dbconn, $sql);
    if(!$result)
    {
      echo pg_last_error($dbconn);
    }
    else
    {
      echo "Deleted successfully\n";
    }
  // Close the connection
  pg_close($dbconn);
  }
}
else
{
  echo "Fix The Corresponding Service Method!";
}