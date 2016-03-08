
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$result = mysqli_query($mysqli, "select * from cars");

$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
echo json_encode($data);

?>