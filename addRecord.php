
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$sql="SELECT MAX(carIndex) from cars";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$carIndex = mysqli_fetch_array($result);
$newCarIndex = $carIndex[0] + 1;

$sql="INSERT INTO cars (make, model, Reg, colour, miles, price, dealer, town, telephone, description, picture, status, region, carIndex) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssssiississssi", $objData->make, $objData->model, $objData->Reg, $objData->colour, $objData->miles, $objData->price, $objData->dealer, $objData->town, $objData->telephone, $objData->description, $objData->picture, $objData->status, $objData->region, $newCarIndex);
$stmt->execute();
$stmt->close();
?>
