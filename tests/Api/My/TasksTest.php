<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\My;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\TaskFactory;
use Polidog\Chatwork\Entity\Task;
use Prophecy\PhpUnit\ProphecyTrait;

class TasksTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerResponseData
     */
    public function testShow($apiResult): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->get('my/tasks', [])
            ->willReturn($apiResult);

        $factory = new TaskFactory();
        $status = new Tasks($client->reveal(), $factory);

        $tasks = $status->show();
        $this->assertInstanceOf(EntityCollection::class, $tasks);

        foreach ($tasks as $task) {
            $this->assertInstanceOf(Task::class, $task);
        }
    }

    public function providerResponseData()
    {
        $data = json_decode('[
  {
    "task_id": 3,
    "room": {
      "room_id": 5,
      "name": "Group Chat Name",
      "icon_path": "https://example.com/ico_group.png"
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
  }
]', true);

        return [
            [$data]
        ];
    }
}
