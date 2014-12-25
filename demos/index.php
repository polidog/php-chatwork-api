<?php
require '../vendor/autoload.php';

define('TOKEN', 'your api token');

// create client
$client = new \Polidog\Chatwork\Client(TOKEN);

//// api/me
//$meEntity = $client->api('me')->show();
//var_dump($meEntity);
//
//
//// api/contacts
//$contacts = $client->api('contacts')->show();
//var_dump($contacts);
//
//
//// rooms
//$rooms = $client->api('rooms')->show();
//// room
//$room = $client->api('rooms')->detail(1);

// create room
// $user = $client->api('me')->show();
// $room = new \Polidog\Chatwork\Entity\Room();
// $room->name = "test room name";
// $members = new \Polidog\Chatwork\Entity\Collection\MembersCollection();
// $member = new \Polidog\Chatwork\Entity\Member();
// $member->account = $user;
// $member->role = 'admin';
// $members->add($member);
//
// $client->api('rooms')->create($room, $members);

// room update
//$room = $client->api('rooms')->detail(27161215);
//$room->name = "update test2";
//$room->description = "ディスクリプションだお";
//
//$client->api('rooms')->update($room);

// get room messages
//$messages = $client->api('rooms')->messages(27161215)->show();
//var_dump($messages);

// create message
//$message = new \Polidog\Chatwork\Entity\Message();
//$message->body = "test";
//$client->api('rooms')->messages(27161215)->create($message);

// get members
//$members = $client->api('rooms')->members(27161215)->show();
//var_dump($members);

// update members
//$members = $client->api('rooms')->members(27161215)->show();
//$client->api('rooms')->members(27161215)->update($members);

// get tasks
//$tasks = $client->api('rooms')->tasks(27161215)->show();
//var_dump($tasks);

// get task detail 
//$task = $client->api('rooms')->tasks(27161215)->detail(19255236);
//var_dump($task);

// file list
//$files = $client->api('rooms')->files(27161215)->show();
//var_dump($files);

// file detail
//$file = $client->api('rooms')->files(27161215)->detail(26652612);
//var_dump($file);


