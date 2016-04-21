
<?php
$data = file_get_contents("php://input");
require 'dbconnect.php';
$objData = json_decode($data);
if($objData->quick === "" && $objData->make === "" && $objData->model === ""  && $objData->reg === "" && $objData->colour === "" && $objData->milage === "" && $objData->price === "") {

$sql = "select * from cars LIMIT 0, ? ";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $objData->dataCount);

$sql2 = "select count(*) as count from cars";
$stmt2 = $mysqli->prepare($sql2);

}
elseif ($objData->make !== "" || $objData->model !== "" || $objData->reg !== "" || $objData->colour !== "" || $objData->milage !== "" || $objData->price !== "") {

  // $sql="select * from cars WHERE make=? AND model=? LIMIT 0, ?";
  // $stmt = $mysqli->prepare($sql);
  // $stmt->bind_param("ssi",$objData->make,$objData->model, $objData->dataCount);
  //
  //
  // $sql2="select count(*) as count from cars WHERE make=? AND model=?";
  // $stmt2 = $mysqli->prepare($sql2);
  // $stmt2->bind_param("ss",$objData->make,$objData->model);

  if($objData->model === ""  && $objData->reg === "" && $objData->colour === "" && $objData->milage === "" && $objData->price === "") {

    $sql="select * from cars WHERE make=? LIMIT 0, ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si",$objData->make, $objData->dataCount);


    $sql2="select count(*) as count from cars WHERE make=?";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param("s",$objData->make);
  }
  else if($objData->make === "" && $objData->reg === "" && $objData->colour === "" && $objData->milage === "" && $objData->price === "") {
    $sql="select * from cars WHERE model=? LIMIT 0, ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si",$objData->model, $objData->dataCount);


    $sql2="select count(*) as count from cars WHERE model=?";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param("s",$objData->model);

  }
  else if($objData->model === "" && $objData->make === "" && $objData->colour === "" && $objData->milage === "" && $objData->price === "") {
    $sql="select * from cars WHERE Reg=? LIMIT 0, ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si",$objData->reg, $objData->dataCount);


    $sql2="select count(*) as count from cars WHERE Reg=?";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param("s",$objData->reg);

  }
  else if($objData->make === "" && $objData->model === ""  && $objData->reg === "" && $objData->milage === "" && $objData->price === "") {

    $sql="select * from cars WHERE colour = ? LIMIT 0, ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si", $objData->colour, $objData->dataCount);

    $sql2="select count(*) as count from cars WHERE colour=?";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param("s",$objData->colour);

  }
  else if($objData->make == "" && $objData->model == ""  && $objData->reg == "" && $objData->colour == "" && $objData->price == "") {

    $sql="select * from cars WHERE miles = ? LIMIT 0, ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $objData->milage, $objData->dataCount);

    $sql2="select count(*) as count from cars WHERE miles=?";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param("i",$objData->milage);

  }

  else if($objData->make == "" && $objData->model == ""  && $objData->reg == "" && $objData->colour == "" && $objData->milage == "") {
    $sql="select * from cars WHERE price = ? LIMIT 0, ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $objData->price, $objData->dataCount);

    $sql2="select count(*) as count from cars WHERE price=?";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param("i",$objData->price);

  }



}
elseif ($objData->quick !== "") {

  $sql = "select * from cars WHERE make LIKE ? OR model LIKE ? OR Reg LIKE ? OR colour LIKE ? OR miles LIKE ? OR price LIKE ? OR dealer LIKE ? OR town LIKE ? OR telephone LIKE ? OR description LIKE ? OR region LIKE ? LIMIT 0, ? ";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ssssiississi", $objData->quick, $objData->quick,$objData->quick, $objData->quick,$objData->quick, $objData->quick,$objData->quick, $objData->quick,$objData->quick, $objData->quick, $objData->quick, $objData->dataCount);

  $sql2 = "select count(*) as count from cars WHERE make LIKE ? OR model LIKE ? OR Reg LIKE ? OR colour LIKE ? OR miles LIKE ? OR price LIKE ? OR dealer LIKE ? OR town LIKE ? OR telephone LIKE ? OR description LIKE ? OR region LIKE ?";
  $stmt2 = $mysqli->prepare($sql2);
  $stmt2->bind_param("ssssiississ", $objData->quick, $objData->quick,$objData->quick, $objData->quick,$objData->quick, $objData->quick,$objData->quick, $objData->quick,$objData->quick, $objData->quick, $objData->quick);
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



?>
