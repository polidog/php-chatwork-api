<?php
/**
 * Created by JetBrains PhpStorm.
 * User: polidog
 * Date: 2013/11/28
 * Time: 22:48
 * To change this template use File | Settings | File Templates.
 */

require './vendor/autoload.php';

$client = new \Chatwork\Client();
$client->authenticate('your api token');
//var_dump($client->api('me')->show());
//var_dump($client->api('my')->status());
//var_dump($client->api('my')->tasks());

var_dump($client->api('rooms')->members(1)->show());

