<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Expose-Headers: Content-Length, Content-Range");

$host = "localhost";
$port = "5432";
$dbname = "Productionnew";
$user = "postgres";
$password = "candy@345";
$pg_options = "--client_encoding=UTF8";

$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} options='{$pg_options}'";
$dbconn = pg_connect($connection_string);

if(!$dbconn){
    echo "Error in connecting to database.";
}