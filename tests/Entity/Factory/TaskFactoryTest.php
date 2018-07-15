<?php

namespace Polidog\Chatwork\Entity\Factory;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Entity\Room;
use Polidog\Chatwork\Entity\Task;
use Polidog\Chatwork\Entity\User;

class TaskFactoryTest extends TestCase
{
    public function testCreateTaskEntity()
    {
        $taskFactory = new TaskFactory();
        $entity = $taskFactory->entity(json_decode('{
            "task_id": 3,
            "room": {
              "room_id": 5,
              "name": "Group Chat Name",
              "icon_path": "https://example.com/ico_group.png"
            },
            "account": {
              "account_id": 123,
              "name": "Bob",
              "avatar_image_url": "https://example.com/abc.png"
            },            
            "assigned_by_account": {
              "account_id": 456,
              "name": "Anna",
              "avatar_image_url": "https://example.com/def.png"
            },
            "message_id": "13",
            "body": "buy milk",
            "limit_time": 1384354799,
            "status": "open"
        }', true));

        $this->assertInstanceOf(Task::class, $entity);
        $this->assertInstanceOf(Room::class, $entity->room);
        $this->assertInstanceOf(User::class, $entity->account);
        $this->assertInstanceOf(User::class, $entity->assignedByAccount);

        $this->assertEquals(3, $entity->taskId);
        $this->assertEquals('13', $entity->messageId);
        $this->assertEquals('buy milk', $entity->body);
        $this->assertEquals(1384354799, $entity->limitTime);
        $this->assertEquals('open', $entity->status);
    }
}
