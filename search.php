
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
  $sql="select * from cars";
  $stmt = $mysqli->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
  $sql="select * from cars WHERE colour = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("s", $objData->colour);
  $stmt->execute();
  $result = $stmt->get_result();
}

else if($objData->colour === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE miles <= ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $objData->milage);
  $stmt->execute();
  $result = $stmt->get_result();
}
// else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
//
//   $sql="select * from cars WHERE make=?";
//   $stmt = $mysqli->prepare($sql);
//   $stmt->bind_param("s", $objData->make);
//   $stmt->execute();
//   $result = $stmt->get_result();
// }
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE make=? AND model= ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $objData->make, $objData->carmodel);
  $stmt->execute();
  $result = $stmt->get_result();
}

else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE price >= ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $objData->minprice);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any') {

  $sql="select * from cars WHERE price <= ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $objData->maxprice);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any') {

  $sql="select * from cars WHERE price BETWEEN ? AND ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ii", $objData->minprice, $objData->maxprice);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE colour= ? AND make=? AND model= ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sss", $objData->colour, $objData->make, $objData->carmodel);
  $stmt->execute();
  $result = $stmt->get_result();
}
else {
$sql="select * from cars WHERE colour=? AND miles=? AND make=? AND model=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("siss",$objData->colour, $objData->milage, $objData->make,$objData->carmodel);
$stmt->execute();
$result = $stmt->get_result();
}

$data = array();
while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
echo json_encode($data);
?>
