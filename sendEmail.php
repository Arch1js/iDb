
<?php
$data = file_get_contents("php://input");

require '/Mailgun/vendor/autoload.php';
use Mailgun\Mailgun;
$objData = json_decode($data);
$email = $objData->email;

$make = $objData->make;
$model = $objData->model;
$miles = $objData->miles;
$price = $objData->price;
$colour = $objData->colour;
$html  = file_get_contents('./views/display.html');
# Instantiate the client.
$mgClient = new Mailgun('key-e1d7a2420aca5f5c0af1a2ae26d59fda');
$domain = "sandbox5580d8574ff84171ac13fc5f19bc9567.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'CarGo <a.dobrajs@gmail.com>',
                        'to'      => "<$email>",
                        'subject' => "Information on $make from CarGo",
                        'text'    => "Make: $make
Model: $model
Miles: $miles
Price: $price
Colour: $colour",
                        'recipient-variables' => '{"bob@example.com": {"first":"Bob", "id":1},
                                         "alice@example.com": {"first":"Alice", "id": 2}}'));

$stmt->close();
?>
