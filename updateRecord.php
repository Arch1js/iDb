<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);
$index = 1001;

$sql="UPDATE cars SET make=?, model=?, Reg=?, colour=?, miles=?, price=?, dealer=?, town=?, telephone=?, description=?, region=?, status=?, picture=? WHERE carIndex=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssssiississssi", $objData->make, $objData->model, $objData->Reg, $objData->colour, $objData->miles, $objData->price, $objData->dealer, $objData->town, $objData->telephone, $objData->description, $objData->region, $objData->status, $objData->picture, $objData->index);
$stmt->execute();

?>
