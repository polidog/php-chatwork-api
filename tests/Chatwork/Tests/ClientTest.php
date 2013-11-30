<?php
namespace Chatwork\Tests;

use Chatwork\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider apiProvider
     */
    public function APIオブジェクトを取得する($name, $className)
    {
        $client = new Client();
        $actual = $client->api($name);
        $this->assertInstanceOf($className, $actual);
    }

    public function apiProvider()
    {
        return [
            ["me","Chatwork\Api\Me"],
            ["my","Chatwork\Api\My"],
            ["contacts","Chatwork\Api\Contacts"],
            ["rooms","Chatwork\Api\Rooms"],
        ];
    }
} 