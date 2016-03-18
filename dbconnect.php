<?php

$host = "cars.cr3lqvgcf76h.us-west-2.rds.amazonaws.com";
$user = "archijs";
$password = "artu3005";
$db = "Cars";

/*$host = "localhost";
$user = "root";
$password = "";
$db = "cars";*/

    $mysqli=mysqli_connect($host,$user,$password,$db);
    if (!$mysqli)
  {
  die("Connection error: " . mysqli_connect_error());
  }
?>