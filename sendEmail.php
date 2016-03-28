
<?php
$data = file_get_contents("php://input");
# Include the Autoloader (see "Libraries" for install instructions)
require '/Mailgun/vendor/autoload.php';
use Mailgun\Mailgun;
$objData = json_decode($data);
// $email = $objData->email;
$email = 'a.dobrajs@gmail.com';
$html  = file_get_contents('./views/display.html');
# Instantiate the client.
$mgClient = new Mailgun('key-e1d7a2420aca5f5c0af1a2ae26d59fda');
$domain = "sandbox5580d8574ff84171ac13fc5f19bc9567.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'CarGo <a.dobrajs@gmail.com>',
                        'to'      => "<$email>",
                        'subject' => 'Car information',
                        'text'    => 'Information about the car you looked at: ',
                        'recipient-variables' => '{"bob@example.com": {"first":"Bob", "id":1},
                                         "alice@example.com": {"first":"Alice", "id": 2}}'));
                        // 'html'    => $html));

?>
