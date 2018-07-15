<?php

namespace Polidog\Chatwork\Entity;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Entity\Factory\RoomFactory;

class RoomTest extends TestCase
{
    /**
     * @test
     */
    public function testRoomEntityToArray()
    {
        $data = json_decode('{
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
        }', true);
        $factory = new RoomFactory();
        $entity = $factory->entity($data);

        $this->assertEquals($data, $entity->toArray());
    }
}
