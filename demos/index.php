<?php
require '../vendor/autoload.php';

define('TOKEN', 'e5454489d74933637e7cf492b9a3c59a');

// create client
$client = new \Polidog\Chatwork\Client(TOKEN);

//// api/me
//$meEntity = $client->api('me')->show();
//var_dump($meEntity);

// api/contacts
//$contacts = $client->api('contacts')->show();
//var_dump($contacts);

// rooms
//$rooms = $client->api('rooms')->show();
//var_dump($rooms);

// room
//$room = $client->api('rooms')->detail(5510526);
//var_dump($room);

// create room
//$user = $client->api('me')->show();
//$room = new \Polidog\Chatwork\Entity\Room();
//$room->name = "test room name2";
//$members = new \Polidog\Chatwork\Entity\Collection\MembersCollection();
//$member = new \Polidog\Chatwork\Entity\Member();
//$member->account = $user;
//$member->role = 'admin';
//$members->add($member);
//$client->api('rooms')->create($room, $members);
//var_dump($room);

// room update
//$room = $client->api('rooms')->detail(27161215);
//$room->name = "update test2";
//$room->description = "ディスクリプションだお2";
//
//$client->api('rooms')->update($room);

// get room messages
//$messages = $client->api('rooms')->messages(27161215)->show();
//var_dump($messages);

// create message
//$message = new \Polidog\Chatwork\Entity\Message();
//$message->body = "今日は".date("Y年m月d日")."ですね。";
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


