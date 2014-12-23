<?php
require './vendor/autoload.php';


$client = new Polidog\Chatwork\Client('e5454489d74933637e7cf492b9a3c59a');
$data = $client->api('me')->show();
var_dump($data);


//$client = new \Chatwork\Client();
//$client->authenticate('4596ce2716db695e1c88884e9fa3041d');
////var_dump($client->api('me')->show());
////var_dump($client->api('my')->status());
//var_dump($client->api('my')->tasks());
//
//var_dump($client->api('rooms')->members(1)->show());

