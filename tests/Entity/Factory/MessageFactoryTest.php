<?php

namespace Polidog\Chatwork\Entity\Factory;

use Polidog\Chatwork\Entity\Message;
use Polidog\Chatwork\Entity\User;

class MessageFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function Messageエンティティを生成する()
    {
        $factory = new MessageFactory();
        $entity = $factory->entity(json_decode('{
            "message_id": "5",
            "account": {
              "account_id": 123,
              "name": "Bob",
              "avatar_image_url": "https://example.com/ico_avatar.png"
            },
            "body": "Hello Chatwork!",
            "send_time": 1384242850,
            "update_time": 0
        }', true));

        $this->assertInstanceOf(Message::class, $entity);
        $this->assertInstanceOf(User::class, $entity->account);

        $this->assertEquals('5', $entity->messageId);
        $this->assertEquals('Hello Chatwork!', $entity->body);
        $this->assertEquals(1384242850, $entity->sendTime);
        $this->assertEquals(0, $entity->updateTime);
    }
}
