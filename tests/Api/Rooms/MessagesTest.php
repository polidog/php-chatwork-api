<?php

namespace Polidog\Chatwork\Api\Rooms;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Phake;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;
use Polidog\Chatwork\Entity\Message;

class MessagesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function 一覧を取得する()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);
        $factory = Phake::mock(FactoryInterface::class);

        Phake::when($httpClient)
            ->get($this->isType('array'), $this->isType('array'))
            ->thenReturn($response);

        Phake::when($response)
            ->json()
            ->thenReturn([]);

        $messages = new Messages(1, $httpClient, $factory);
        $messages->show();

        Phake::verify($httpClient, Phake::times(1))
            ->get(
                ['rooms/{roomId}/messages', ['roomId' => 1]],
                [
                    'query' => [
                        'force' => 0,
                    ],
                ]
            );

        Phake::verify($response, Phake::times(1))
            ->json();

        Phake::verify($factory, Phake::times(1))
            ->collection($this->isType('array'));
    }

    /**
     * @test
     */
    public function idを指定してメッセージを取得する()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);
        $factory = Phake::mock(FactoryInterface::class);

        Phake::when($httpClient)
            ->get($this->isType('array'), $this->isType('array'))
            ->thenReturn($response);

        Phake::when($response)
            ->json()
            ->thenReturn([]);

        $messages = new Messages(1, $httpClient, $factory);
        $messages->detail(1);

        Phake::verify($httpClient, Phake::times(1))
            ->get(
                ['rooms/{roomId}/messages/{id}', ['roomId' => 1, 'id' => 1]],
                [
                    'query' => [
                        'force' => 0,
                    ],
                ]
            );

        Phake::verify($response, Phake::times(1))
            ->json();

        Phake::verify($factory, Phake::times(1))
            ->entity($this->isType('array'));
    }

    /**
     * @test
     */
    public function 新しいメッセージを登録する()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);

        $message = new Message();
        $message->body = 'hogehoge';

        Phake::when($httpClient)
            ->post($this->isType('array'), $this->isType('array'))
            ->thenReturn($response);

        Phake::when($response)
            ->json()
            ->thenReturn([
                'message_id' => '123456',
            ]);

        $messages = new Messages(1, $httpClient);
        $messages->create($message);

        Phake::verify($httpClient, Phake::times(1))
            ->post(
                ['rooms/{roomId}/messages', ['roomId' => 1]],
                [
                    'body' => [
                        'body' => 'hogehoge',
                    ],
                ]
            );

        Phake::verify($response, Phake::times(1))
            ->json();

        $this->assertEquals('123456', $message->messageId);
    }
}
