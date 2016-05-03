
<?php
$data = file_get_contents("php://input");
require 'dbconnect.php';
$objData = json_decode($data);

$sql = "select * from cars WHERE make=? and model=? and colour=? and price=? and miles=? and status='available'";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssii", $objData->make, $objData->model, $objData->colour, $objData->price, $objData->miles);

$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}

echo json_encode($data);
$stmt->close();
?>
