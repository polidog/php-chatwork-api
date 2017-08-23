php-chatwork-api
================

[![Build Status](https://travis-ci.org/polidog/php-chatwork-api.png?branch=develop)](https://travis-ci.org/polidog/php-chatwork-api)
[![Coverage Status](https://img.shields.io/coveralls/polidog/php-chatwork-api.svg)](https://coveralls.io/r/polidog/php-chatwork-api?branch=master)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/polidog/php-chatwork-api/badges/quality-score.png?s=56ea782f70ecfbe3de485e4be2a2c585455e44e3)](https://scrutinizer-ci.com/g/polidog/php-chatwork-api/)
[![Latest Stable Version](https://poser.pugx.org/polidog/php-chatwork-api/v/stable.svg)](https://packagist.org/packages/polidog/php-chatwork-api)
[![Total Downloads](https://poser.pugx.org/polidog/php-chatwork-api/downloads.svg)](https://packagist.org/packages/polidog/php-chatwork-api)
[![License](https://poser.pugx.org/polidog/php-chatwork-api/license.svg)](https://packagist.org/packages/polidog/php-chatwork-api)

[Chatwork](http://www.chatwork.com/ja/) APIをPHPから利用するためのライブラリです。

## 動くPHPのバージョン
- PHP5.5以上

5.5以下の場合はv0.1.1だったら動きます(たぶん)。


## Install

composer.jsonに以下の記述を加えてください。

```
{
  "require": {
    "polidog/php-chatwork-api": "2.x-dev",
    "cakephp/utility": "3.0.0-beta3"
  }
}
```


## Quick Example

利用する前に必ずChatWorkのAPIキーを用意しておいてください。
[APIキーの確認方法](http://developer.chatwork.com/ja/authenticate.html)を確認してください。

### オブジェクトを取得する

```
// ChatWork API Clientオブジェクトの初期化
$client = new \Polidog\Chatwork\Client("chatwork api token");
```

### 自分自身の情報(APIキーの所有者)

```
$user = $client->api('me')->show();

// APIのレスポンスはすべてオブジェクトの形で取得できます
var_dump($user);
```

### チャットルーム一覧を取得する

```
$rooms = $client->api('rooms')->show();
var_dump($rooms);
```

### チャットルームを作成する
ここちょっと面倒くさい感じになってしまってます。。

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
```

### チャットルームのメンバー一覧を取得する
```
$members = $client->api('rooms')->members(123456/* roomidを指定します。*/);
var_dump($members);

```


## 関連リンク
- [ChatWork API](http://developer.chatwork.com/ja/)
