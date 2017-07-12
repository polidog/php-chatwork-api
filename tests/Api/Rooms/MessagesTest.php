<?php

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\ClientInterface;
use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\MessageFactory;
use Polidog\Chatwork\Entity\Message;

class MessagesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerMessages
     * @param $apiResult
     */
    public function testShow($apiResult)
    {
        $roomId = 1;

        $client = $this->prophesize(ClientInterface::class);
        $client->request("GET","rooms/{$roomId}/messages", [
            'query' => [
                'force' => 0,
            ]
        ])->willReturn($apiResult);

        $factory = new MessageFactory();
        $api = new Messages($roomId, $client->reveal(), $factory);
        $messages = $api->show();

        $this->assertInstanceOf(EntityCollection::class, $messages);
        foreach ($messages as $message) {
            $this->assertInstanceOf(Message::class, $message);
        }
    }

    /**
     * @dataProvider providerMessage
     * @param $apiResult
     */
    public function testDetail($apiResult)
    {
        $roomId = 1;
        $messageId = 11;

        $client = $this->prophesize(ClientInterface::class);
        $client->request("GET","rooms/{$roomId}/messages/{$messageId}", [
            'query' => [
                'force' => 0,
            ]
        ])->willReturn($apiResult);

        $factory = new MessageFactory();
        $api = new Messages($roomId, $client->reveal(), $factory);
        $message = $api->detail($messageId);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testCreate()
    {
        $roomId = 1;
        $messageId = 11;
        $message = new Message();
        $message->body = 'hoge';

        $client = $this->prophesize(ClientInterface::class);
        $client->request("POST","rooms/{$roomId}/messages",[
            'form_params' => [
                'body' => $message->body
            ]
        ])->willReturn(['message_id' => 1234]);

        $factory = new MessageFactory();
        $api = new Messages($roomId, $client->reveal(), $factory);

        $api->create($message);

        $this->assertEquals(1234, $message->messageId);

    }

    public function providerMessages()
    {
        $data = json_decode('[
  {
    "message_id": "5",
    "account": {
      "account_id": 123,
      "name": "Bob",
      "avatar_image_url": "https://example.com/ico_avatar.png"
    },
    "body": "Hello Chatwork!",
    "send_time": 1384242850,
    "update_time": 0
  }
]', true);

        return [
            [$data]
        ];
    }

    public function providerMessage()
    {
        $data = json_decode('{
  "message_id": "5",
  "account": {
    "account_id": 123,
    "name": "Bob",
    "avatar_image_url": "https://example.com/ico_avatar.png"
  },
  "body": "Hello Chatwork!",
  "send_time": 1384242850,
  "update_time": 0
}', true);

        return [
            [$data]
        ];
    }

}
