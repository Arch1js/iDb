<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$add = mysqli_query($mysqli, "INSERT INTO customers (firstName, lastName, address, email) VALUES ('$objData->name', '$objData->lastName', '$objData->address', '$objData->email')");

$addPayment = mysqli_query($mysqli, "INSERT INTO payments (cardNo, expMonth, expYear, CVV) VALUES ('$objData->cardNo', '$objData->month', '$objData->year', '$objData->cvv')");

?>