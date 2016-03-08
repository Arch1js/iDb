
<?php

$data = file_get_contents("php://input");

require 'dbconnect.php';

$objData = json_decode($data);

$result = mysqli_query($mysqli, "select * from cars WHERE make='VW'");

/*if($objData->colour === 'Any') {

    $result = mysqli_query($mysqli, "select * from cars WHERE make='$objData->make' AND miles $objData->milage");
    
}

else {
    
$result = mysqli_query($mysqli, "select * from cars WHERE colour='$objData->colour' AND make='$objData->make' AND miles $objData->milage AND model='$objData->carmodel' AND price BETWEEN $objData->minprice AND $objData->maxprice");

}*/
$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
echo json_encode($data);

?>