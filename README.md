php-chatwork-api
================

[![Build Status](https://travis-ci.org/polidog/php-chatwork-api.png?branch=develop)](https://travis-ci.org/polidog/php-chatwork-api)
[![Coverage Status](https://coveralls.io/repos/polidog/php-chatwork-api/badge.png)](https://coveralls.io/r/polidog/php-chatwork-api)  


みんな大好きChatWorkのAPIの限定プレビューが始まるということで、早速先走ってAPIラッパークラスをPHPで実装してみました。
まだAPIの使えない僕は、妄想しながら実装したので、動くかどうかは責任とれませんw


## インストール方法


1\. composer.pharを用意します。  
```
$ curl -sS https://getcomposer.org/installer | php
```
2\. comoposer.jsonを用意しましょう

```
{
    "require": {
        "polidog/php-chatwork-api": "dev-develop",
        "kriswallsmith/buzz": "v0.10"
    }
}

```
3\. インストール

```
php composer.phar install
```

4\. 実際につかってみる
```
<?php
require './vendor/autoload.php';

$client = new \Chatwork\Client();
$client->authenticate('your api key');
//var_dump($client->api('me')->show());
//var_dump($client->api('my')->status());
var_dump($client->api('my')->tasks());


