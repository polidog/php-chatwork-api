<?php
namespace Polidog\Chatwork;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Event\Emitter;
use Phake;
use Polidog\Chatwork\Api\Contacts;
use Polidog\Chatwork\Api\Me;
use Polidog\Chatwork\Api\My;
use Polidog\Chatwork\Api\Rooms;
use Polidog\Chatwork\Entity\Factory\RoomFactory;
use Polidog\Chatwork\Entity\Factory\UserFactory;
use Polidog\Chatwork\Http\Event\AuthHeaderSubscriber;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function attachAuthHeaderSubscriber()
    {
        $emitter = Phake::mock(Emitter::class);
        $httpClient = Phake::mock(HttpClientInterface::class);
        Phake::when($httpClient)->getEmitter()->thenReturn($emitter);
        
        $client = new Client('apikeytoken', [], $httpClient);
        
        Phake::verify($emitter,Phake::times(1))->attach(new AuthHeaderSubscriber('apikeytoken'));
    }

    /**
     * @test
     * @dataProvider dp_apiNames
     * 
     * @param string $apiName
     * @param string $apiObjectName
     * @param string $factoryObjectName
     */
    public function selectApiObjects($apiName, $apiObjectName, $factoryObjectName)
    {
        $client = new Client('apikeytoken', []);
        $actual = $client->api($apiName);
        $this->assertInstanceOf($apiObjectName, $actual);
    }

    /**
     * @test
     * @expectedException Polidog\Chatwork\Exception\NoSupportApiException
     */
    public function noApiObject()
    {
        $client = new Client('apikeytoken', []);
        $client->api('hoge');
    }
    
    
    public function dp_apiNames()
    {
        return [
            ['me', Me::class, UserFactory::class],
            ['my', My::class, null],
            ['contacts', Contacts::class, UserFactory::class],
            ['rooms', Rooms::class, RoomFactory::class]
        ];
    }
}