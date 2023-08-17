<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Client;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ClientTest extends TestCase
{
    use ProphecyTrait;

    public function testGet(): void
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getContents()
            ->willReturn('[]');

        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()
            ->willReturn($stream);

        $httpClient = $this->prophesize(\GuzzleHttp\Client::class);
        $httpClient->request('get', '/v2/a/b', [
            'query' => [
                's' => 'test'
            ],
        ])->willReturn($response);

        $client = new Client('test token', 'v2', $httpClient->reveal());
        $client->get('a/b', ['s' => 'test']);

        $httpClient->request('get', '/v2/a/b', [
            'query' => [
                's' => 'test'
            ],
        ])->shouldHaveBeenCalled();
    }

}
