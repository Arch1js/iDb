<?php
$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$sql="select model from cars WHERE make='$objData->make'";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
echo json_encode($data);
$stmt->close();
?>
