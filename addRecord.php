
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$addRecord = mysqli_query($mysqli, "INSERT INTO records (make, model) VALUES ('test121', 'test222')");

?>