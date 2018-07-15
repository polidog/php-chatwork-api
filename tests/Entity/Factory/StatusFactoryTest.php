<?php

namespace Polidog\Chatwork\Entity\Factory;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Entity\Status;

class StatusFactoryTest extends TestCase
{
    public function testCreateStatusEntity()
    {
        $factory = new StatusFactory();
        $entity = $factory->entity(json_decode('{
            "unread_room_num": 2,
            "mention_room_num": 1,
            "mytask_room_num": 3,
            "unread_num": 12,
            "mention_num": 1,
            "mytask_num": 8
        }', true));

        $this->assertInstanceOf(Status::class, $entity);
        $this->assertEquals(2, $entity->unreadRoomNum);
        $this->assertEquals(1, $entity->mentionRoomNum);
        $this->assertEquals(3, $entity->mytaskRoomNum);
        $this->assertEquals(12, $entity->unreadNum);
        $this->assertEquals(1, $entity->mentionNum);
        $this->assertEquals(8, $entity->mytaskNum);
    }
}
