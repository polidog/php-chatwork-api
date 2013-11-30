<?php
namespace Chatwork\Tests;

use Buzz\Exception\InvalidArgumentException;
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
     * @expectedException \Chatwork\Exception\InvalidArgumentException
     */
    public function 存在しないAPIを呼び出した場合はExceptionが発行される()
    {
        $client = new Client();
        $actual = $client->api('hoge');
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
     * @test
     * @expectedException InvalidArgumentException
     */
    public function オプションを取得する際にキーを設定してなかった()
    {
        $client = new Client();
        $client->getOption(null);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function オプションを取得する際に存在しないキーを設定した()
    {
        $client = new Client();
        $client->getOption('hoge');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function オプションをセットするが重複している()
    {
        $client = new Client();
        $client->setOption('hoge','fuga');
        $client->setOption('hoge','fuga');
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