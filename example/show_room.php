<?php
require 'vendor/autoload.php';

if (!getenv('CHATWORK_TOKEN')) {
    echo "[ERROR] token is not found.";
    exit(1);
}

$chatwork = \Polidog\Chatwork\Chatwork::create(getenv('CHATWORK_TOKEN'));
var_dump($chatwork->me()->show());
//$room = $chatwork->rooms()->detail(5579115);
//var_dump($room);

