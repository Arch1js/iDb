
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$addRecord = mysqli_query($mysqli, "INSERT INTO cars (make, model) VALUES ('$objData->make', '$objData->model')");

?>