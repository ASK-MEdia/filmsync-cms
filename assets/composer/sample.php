<?php  

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-5ib-iyvj3eqofj-bhv0uf29d03hf0ug3');
$domain = "fingent.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Excited User <nidhin038@gmail.com>',
    'to'      => 'Baz <nidhin.n@fingent.com>',
    'subject' => 'Hello',
    'text'    => 'Testing some Mailgun awesomness!'
));

?>