<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$sql="INSERT INTO customers (firstName, lastName, address, email) VALUES (?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssss", $objData->name, $objData->lastName, $objData->address, $objData->email);
$stmt->execute();

$sql="INSERT INTO payments (cardNo, expMonth, expYear, CVV) VALUES (sha(?),?,?,sha(?))";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iiii", $objData->cardNo, $objData->month, $objData->year, $objData->cvv);
$stmt->execute();
$stm

?>
