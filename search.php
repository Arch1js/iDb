
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
  $sql="select * from cars WHERE status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE status='available'";
  $stmt2 = $mysqli->prepare($sql2);

}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any' && $objData->carmodel === 'Any') {

  $sql="select * from cars WHERE make=? AND status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("si", $objData->make, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE make=? AND status='available'";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("s",$objData->make);

}
else if($objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
  $sql="select * from cars WHERE colour = ? AND status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("si", $objData->colour, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE colour = ? AND status='available'";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("s",$objData->colour);

}
else if($objData->colour === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE miles <= ? AND status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ii", $objData->milage, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE miles <= ? AND status='available'";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("s",$objData->milage);

}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE price >= ? AND status='available' ORDER BY price ASC LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ii", $objData->minprice, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE price >= ? AND status='available' ORDER BY price ASC";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("i",$objData->minprice);

}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any' && $objData->minprice === 'Any') {

  $sql="select * from cars WHERE price <= ? AND status='available' ORDER BY price DESC LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ii", $objData->maxprice, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE price <= ? AND status='available' ORDER BY price DESC";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("i",$objData->maxprice);

}
else if($objData->make === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {
  $sql="select * from cars WHERE colour = ? AND miles <= ? AND status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sii", $objData->colour, $objData->milage, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE colour = ? AND miles <= ? AND status='available'";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("si",$objData->colour, $objData->milage);

}

else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE make=? AND model= ? AND status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ssi", $objData->make, $objData->carmodel, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE make=? AND model= ? AND status='available'";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("ss",$objData->make, $objData->carmodel);

}
else if($objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE make=? AND model= ? AND colour=? AND status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sssi", $objData->make, $objData->carmodel, $objData->colour, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE make=? AND model= ? AND colour=? AND status='available'";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("sss",$objData->make, $objData->carmodel, $objData->colour);

}
else if($objData->colour === 'Any' && $objData->milage === 'Any' && $objData->make === 'Any') {

  $sql="select * from cars WHERE price BETWEEN ? AND ? AND status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("iii", $objData->minprice, $objData->maxprice, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE price BETWEEN ? AND ? AND status='available'";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("ii",$objData->minprice, $objData->maxprice);

}
else if($objData->milage === 'Any' && $objData->minprice === 'Any' && $objData->maxprice === 'Any') {

  $sql="select * from cars WHERE colour= ? AND make=? AND model= ? AND status='available' LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sssi", $objData->colour, $objData->make, $objData->carmodel, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE colour= ? AND make=? AND model= ? AND status='available'";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("sss",$objData->colour, $objData->make, $objData->carmodel);

}
else if($objData->make === 'Any' && $objData->carmodel === 'Any') {

  $sql="select * from cars WHERE colour= ? AND miles=? AND status='available' AND price BETWEEN ? AND ? LIMIT 0, ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("siiii", $objData->colour, $objData->milage, $objData->minprice, $objData->maxprice, $objData->dataCount);

  $sql2="select count(*) as count from cars WHERE colour= ? AND miles=? AND status='available' AND price BETWEEN ? AND ?";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("siii",$objData->colour, $objData->milage, $objData->minprice, $objData->maxprice);

}
else {
$sql="select * from cars WHERE colour=? AND miles=? AND make=? AND model=? AND status='available' LIMIT 0, ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sissi",$objData->colour, $objData->milage, $objData->make,$objData->carmodel, $objData->dataCount);

$sql2="select count(*) as count from cars WHERE colour=? AND miles=? AND make=? AND model=? AND status='available'";
$stmt2 = $mysqli->prepare($sql2);
$stmt2->bind_param("siss",$objData->colour, $objData->milage, $objData->make,$objData->carmodel);

}

$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}

$stmt2->execute();
$result2 = $stmt2->get_result();
$data2 = array();

while ($row2 = mysqli_fetch_array($result2)) {
  $data2[] = $row2;
}

echo json_encode(array($data,$data2));

$stmt->close();
?>
