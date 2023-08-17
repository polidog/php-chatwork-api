<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity\Factory;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Entity\Message;
use Polidog\Chatwork\Entity\User;

class MessageFactoryTest extends TestCase
{
    public function testCreateMessageEntity(): void
    {
        $factory = new MessageFactory();
        $entity = $factory->entity(json_decode('{
            "message_id": "5",
            "account": {
              "account_id": 123,
              "name": "Bob",
              "avatar_image_url": "https://dummyimage.com/600x400/000/fff.png"
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
