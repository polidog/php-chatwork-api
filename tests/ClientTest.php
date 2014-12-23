<?php
namespace Polidog\Chatwork;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Event\Emitter;
use Phake;
use Polidog\Chatwork\Api\Me;
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
     */
    public function selectApiObjects($apiName, $apiObjectName)
    {
        $client = new Client('apikeytoken', []);
        $actual = $client->api($apiName);
        $this->assertInstanceOf($apiObjectName, $actual);
    }
    
    
    public function dp_apiNames()
    {
        return [
            ['me', Me::class]
        ];
    }
}