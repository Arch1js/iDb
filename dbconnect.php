<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "cars";

    $mysqli=mysqli_connect($host,$user,$password,$db);
    if (!$mysqli)
  {
  die("Connection error: " . mysqli_connect_error());
  }
?>