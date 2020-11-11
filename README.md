php-chatwork-api
================

![test](https://github.com/polidog/php-chatwork-api/workflows/test/badge.svg)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/polidog/php-chatwork-api/badges/quality-score.png?s=56ea782f70ecfbe3de485e4be2a2c585455e44e3)](https://scrutinizer-ci.com/g/polidog/php-chatwork-api/)
[![Latest Stable Version](https://poser.pugx.org/polidog/php-chatwork-api/v/stable.svg)](https://packagist.org/packages/polidog/php-chatwork-api)
[![Total Downloads](https://poser.pugx.org/polidog/php-chatwork-api/downloads.svg)](https://packagist.org/packages/polidog/php-chatwork-api)
[![License](https://poser.pugx.org/polidog/php-chatwork-api/license.svg)](https://packagist.org/packages/polidog/php-chatwork-api)

[Chatwork](http://www.chatwork.com/ja/) APIをPHPから利用するためのライブラリです。

## Install

```
$ composer require polidog/php-chatwork-api
```


## Quick Example

利用する前に必ずChatWorkのAPIキーを用意しておいてください。  
[APIキーの確認方法](http://developer.chatwork.com/ja/authenticate.html)を確認してください。

### オブジェクトを取得する

```
// ChatWork API Clientオブジェクトの初期化
$chatwork = \Polidog\Chatwork\Chatwork::create("chatwork api token");
```

### 自分自身の情報(APIキーの所有者)

```
$user = $chatwork->me()->show();

// APIのレスポンスはすべてオブジェクトの形で取得できます
var_dump($user);
```

### チャットルーム一覧を取得する

```
$rooms = $chatwork->rooms()->show();
var_dump($rooms);
```

### チャットルームを作成する

```
// まずはRoomクラスを用意する
$room = new \Polidog\Chatwork\Entity\Room();
$room->name = 'test chat';

// 次にメンバー一覧を用意する
$members = new \Polidog\Chatwork\Entity\Collection\MembersCollection();
$member = new \Polidog\Chatwork\Entity\Member();
$member->role = 'admin';
$member->account = $user;
$members->add($member);

$chatwork->rooms()->create($room, $members)
```

### チャットルームのメンバー一覧を取得する
```
$members = $client->rooms()->members(123456/* roomidを指定します。*/);
var_dump($members);

```

### チャットルームのメッセージ一覧を取得する
```
// $force(0: 新しいメッセージのみ, 1: ラスト100メッセージ)
$messages = $client->rooms()->messages($room_id)->show($force);
```

### メッセージ送信
```
$message = new \Polidog\Chatwork\Entity\Message();
$message->body = 'メッセージ内容';
$client->rooms()->messages($room_id)->create($message);
```

### メッセージ更新
```
$message = new \Polidog\Chatwork\Entity\Message();
$message->body = 'メッセージ内容';
// $message_id(メッセージのID)
$client->rooms()->messages($room_id)->update($message, $message_id);
```

### メッセージ削除
```
// $message_id(メッセージのID)
$client->rooms()->messages($room_id)->delete($message_id);
```

### チャットルームのファイル一覧を取得する
```
$files = $client->rooms()->files($room_id)->show();
```

### ファイル情報を取得する
```
$files = $client->rooms()->files($room_id)->detail($file_id);
```

## 関連リンク
- [ChatWork API](http://developer.chatwork.com/ja/)
