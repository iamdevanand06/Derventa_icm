<?php 

require_once 'connect.php';
if ($_SERVER["REQUEST_METHOD"] === 'GET')
{
    $result = pg_query($dbconn, "SELECT * FROM rchr_approvalhistrory");
    if (!$result) 
    {
        echo "An error occurred.\n";
        exit;
    }

    $arr = pg_fetch_all($result);
    header("Content-type:application/json");
    echo json_encode($arr);

}
else
{
  echo "Fix The Corresponding Service Method!";
}