<?php

namespace Polidog\Chatwork;

use GuzzleHttp\HandlerStack;
use Polidog\Chatwork\Api\Contacts;
use Polidog\Chatwork\Api\Me;
use Polidog\Chatwork\Api\My;
use Polidog\Chatwork\Api\Rooms;
use Polidog\Chatwork\Exception\NoSupportApiException;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTestApi
     */
    public function testApi($name, $expectClass)
    {
        $client = new Client('test token');
        $api = $client->api($name);
        $this->assertInstanceOf($expectClass, $api);
    }

    /**
     * @expectedException Polidog\Chatwork\Exception\NoSupportApiException
     */
    public function testNoSupportApi()
    {
        $client = new Client('test token');
        $client->api('mine');
    }

    public function testRequest()
    {
        $method = "GET";
        $path = "me";
        $url = sprintf("/%s/%s", Client::API_VERSION, $path);

        $stream = $this->prophesize(StreamInterface::class);
        $stream->getContents()
            ->willReturn("");

        $response = $this->prophesize(RequestInterface::class);
        $response->getBody()
            ->willReturn($stream);


        $httpClient = $this->prophesize(\GuzzleHttp\Client::class);
        $httpClient->request($method, $url, [])
            ->willReturn($response);


        $httpClient->getConfig('handler')->willReturn(HandlerStack::create());


        $client = new Client('test token',[], $httpClient->reveal());
        $client->request($method, $path, []);


    }

    public function testTokenHandler()
    {
        $guzzleClient = new \GuzzleHttp\Client();
        $client = new Client('test token', [], $guzzleClient);

    }


    public function providerTestApi()
    {
        return [
            ['me', Me::class],
            ['my', My::class],
            ['contacts', Contacts::class],
            ['rooms', Rooms::class],
        ];
    }

//    /**
//     * @test
//     */
//    public function attachAuthHeaderSubscriber()
//    {
//        $emitter = Phake::mock(Emitter::class);
//        $httpClient = Phake::mock(HttpClientInterface::class);
//        Phake::when($httpClient)->getEmitter()->thenReturn($emitter);
//
//        $client = new Client('apikeytoken', [], $httpClient);
//
//        Phake::verify($emitter, Phake::times(1))->attach(new AuthHeaderSubscriber('apikeytoken'));
//    }
//
//    /**
//     * @test
//     * @dataProvider dp_apiNames
//     *
//     * @param string $apiName
//     * @param string $apiObjectName
//     * @param string $factoryObjectName
//     */
//    public function selectApiObjects($apiName, $apiObjectName, $factoryObjectName)
//    {
//        $client = new Client('apikeytoken', []);
//        $actual = $client->api($apiName);
//        $this->assertInstanceOf($apiObjectName, $actual);
//    }
//
//    /**
//     * @test
//     * @expectedException \Polidog\Chatwork\Exception\NoSupportApiException
//     */
//    public function noApiObject()
//    {
//        $client = new Client('apikeytoken', []);
//        $client->api('hoge');
//    }
//
//    public function dp_apiNames()
//    {
//        return [
//            ['me', Me::class, UserFactory::class],
//            ['my', My::class, null],
//            ['contacts', Contacts::class, UserFactory::class],
//            ['rooms', Rooms::class, RoomFactory::class],
//        ];
//    }
}
