<?php


namespace Polidog\Chatwork\Client;


use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

class ClientTest extends TestCase
{
    public function testGet()
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getContents()
            ->willReturn('[]');

        $response = $this->prophesize(RequestInterface::class);
        $response->getBody()
            ->willReturn($stream);

        $httpClient = $this->prophesize(\GuzzleHttp\Client::class);
        $httpClient->request('get', '/v2/a/b', [
            'query' => [
                's' => 'test'
            ],
        ])->willReturn($response);

        $httpClient->getConfig('handler')->willReturn(HandlerStack::create());

        $client = new Client($httpClient->reveal(),'test token', 'v2');
        $client->get('a/b',['s' => 'test']);

        $httpClient->request('get', '/v2/a/b',[
            'query' => [
                's' => 'test'
            ],
        ])->shouldHaveBeenCalled();
    }

}
