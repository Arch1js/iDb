
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$sql="DELETE FROM cars WHERE CarIndex=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $objData->index);
$stmt->execute();

?>
