
<?php

require 'dbconnect.php';

$result = mysqli_query($mysqli, "select * from cars");

$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
echo json_encode($data);

?>
