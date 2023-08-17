<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity\Factory;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Entity\Room;

class RoomFactoryTest extends TestCase
{
    public function testCreateRoomEntity(): void
    {
        $factory = new RoomFactory();
        $entity = $factory->entity(json_decode('{
            "room_id": 123,
            "name": "Group Chat Name",
            "type": "group",
            "role": "admin",
            "sticky": false,
            "unread_num": 10,
            "mention_num": 1,
            "mytask_num": 0,
            "message_num": 122,
            "file_num": 10,
            "task_num": 17,
            "icon_path": "https://example.com/ico_group.png",
            "last_update_time": 1298905200,
            "description": "room description text"
        }', true));

        $this->assertInstanceOf(Room::class, $entity);
        $this->assertEquals(123, $entity->roomId);
        $this->assertEquals('Group Chat Name', $entity->name);
        $this->assertEquals('group', $entity->type);
        $this->assertEquals('admin', $entity->role);
        $this->assertEquals(false, $entity->sticky);
        $this->assertEquals(10, $entity->unreadNum);
        $this->assertEquals(1, $entity->mentionNum);
        $this->assertEquals(0, $entity->mytaskNum);
        $this->assertEquals(122, $entity->messageNum);
        $this->assertEquals(10, $entity->fileNum);
        $this->assertEquals(17, $entity->taskNum);
        $this->assertEquals('https://example.com/ico_group.png', $entity->iconPath);
        $this->assertEquals(1298905200, $entity->lastUpdateTime);
        $this->assertEquals('room description text', $entity->description);
    }
}
