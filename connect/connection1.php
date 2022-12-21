<?php 

$databaseHost = 'us-cdbr-east-06.cleardb.net:3306';
$databaseName = 'heroku_ab7bf6e4fc63c62';
$databaseUsername = 'bdb806e49b3862';
$databasePassword = 'e66834cf';

$connect = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

/*
// Check connection
if ($mysqli -> connect_error) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}*/
?>