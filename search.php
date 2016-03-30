
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
  $sql="select * from cars WHERE status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any' && $objData->carmodel === 'Any') {

  $sql="select * from cars WHERE make=? AND status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("s", $objData->make);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
  $sql="select * from cars WHERE colour = ? AND status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("s", $objData->colour);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->colour === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE miles <= ? AND status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $objData->milage);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE price >= ? AND status='available' ORDER BY price ASC";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $objData->minprice);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any') {

  $sql="select * from cars WHERE price <= ? AND status='available' ORDER BY price DESC";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $objData->maxprice);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
  $sql="select * from cars WHERE colour = ? AND miles <= ? AND status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("si", $objData->colour, $objData->milage);
  $stmt->execute();
  $result = $stmt->get_result();
}

else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE make=? AND model= ? AND status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $objData->make, $objData->carmodel);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE make=? AND model= ? AND colour=? AND status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sss", $objData->make, $objData->carmodel, $objData->colour);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any') {

  $sql="select * from cars WHERE price BETWEEN ? AND ? AND status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ii", $objData->minprice, $objData->maxprice);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE colour= ? AND make=? AND model= ? AND status='available'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sss", $objData->colour, $objData->make, $objData->carmodel);
  $stmt->execute();
  $result = $stmt->get_result();
}
else if($objData->make === 'Any' && $objData->carmodel === 'Any') {

  $sql="select * from cars WHERE colour= ? AND miles=? AND status='available' AND price BETWEEN ? AND ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("siii", $objData->colour, $objData->milage, $objData->minprice, $objData->maxprice);
  $stmt->execute();
  $result = $stmt->get_result();
}
else {
$sql="select * from cars WHERE colour=? AND miles=? AND make=? AND model=? AND status='available'";
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
