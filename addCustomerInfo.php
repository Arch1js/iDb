<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';
$paymentID = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
$objData = json_decode($data);

$sql="INSERT INTO customers (firstName, lastName, address, email) VALUES (?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssss", $objData->name, $objData->lastName, $objData->address, $objData->email);
$stmt->execute();

$sql="select customerID from customers WHERE firstName=? AND lastName=? AND address=? AND email=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssss",$objData->name, $objData->lastName, $objData->address, $objData->email);
$stmt->execute();
$result = $stmt->get_result();

$customer= mysqli_fetch_array($result);
$customerID = $customer[0];

$sql="INSERT INTO orders (customerID,carIndex,paymentID,cardNo, expMonth, expYear, CVV) VALUES (?,?,?,sha(?),?,?,sha(?))";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iiiiiii",$customerID,$objData->carIndex,$paymentID,$objData->cardNo, $objData->month, $objData->year, $objData->cvv);
$stmt->execute();

$status='unavailable'; //when bought, set car status to unavailable
$sql="UPDATE cars SET status=? WHERE carIndex=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("si", $status, $objData->carIndex);
$stmt->execute();
$stmt->close();
?>
