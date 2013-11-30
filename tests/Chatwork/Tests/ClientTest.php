<?php
namespace Chatwork\Tests;

use Chatwork\Client;
use Chatwork\HttpClient\HttpClient;

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

    /**
     * @test
     */
    public function 認証処理を行う()
    {
        $apiKey = "hogehoge";
        $httpClientMock = $this->getHttpClientMock();
        $httpClientMock->expects($this->once())
            ->method('authenticate')
            ->with($this->equalTo($apiKey));

        $client = new Client($httpClientMock);
        $client->authenticate($apiKey);
    }

    /**
     * @test
     */
    public function HTTPクライアントを取得する()
    {
        $client = new Client();
        $this->assertInstanceOf('\Chatwork\HttpClient\HttpClient', $client->getHttpClient());
    }

    /**
     * @test
     */
    public function HTTPクライアントオブジェクトをセットする()
    {
        $httpClient = new HttpClient();
        $client = new Client();
        $client->setHttpClient($httpClient);
        $this->assertEquals($httpClient, $client->getHttpClient());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getHttpClientMock()
    {
        return $this->getMockBuilder('\Chatwork\HttpClient\HttpClient')
            ->setMethods([
                'authenticate',
                'get',
                'post',
                'put',
                'delete',
                'request',
                'setOption',
                'setHeaders',
                'clearHeaders'
            ])
            ->disableOriginalConstructor()
            ->getMock();
    }



    /**
     * data provider
     * @return array
     */
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