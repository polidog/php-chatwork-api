<?php

namespace Polidog\Chatwork\Api\Rooms;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\MessageFactory;
use Polidog\Chatwork\Entity\Message;

class MessagesTest extends TestCase
{
    /**
     * @dataProvider providerMessages
     * @param $apiResult
     */
    public function testShow($apiResult)
    {
        $roomId = 1;

        $client = $this->prophesize(ClientInterface::class);
        $client->get("rooms/{$roomId}/messages", [
            'force' => 0,
        ])->willReturn($apiResult);

        $factory = new MessageFactory();
        $api = new Messages($client->reveal(), $factory, $roomId);
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
        $client->get("rooms/{$roomId}/messages/{$messageId}", [
            'force' => 0,
        ])->willReturn($apiResult);

        $factory = new MessageFactory();
        $api = new Messages($client->reveal(), $factory, $roomId);
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
        $client->post("rooms/{$roomId}/messages",[
            'body' => $message->body
        ])->willReturn(['message_id' => 1234]);

        $factory = new MessageFactory();
        $api = new Messages($client->reveal(), $factory, $roomId);

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
      "avatar_image_url": "https://dummyimage.com/600x400/000/fff.png"
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
    "avatar_image_url": "https://dummyimage.com/600x400/000/fff.png"
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
