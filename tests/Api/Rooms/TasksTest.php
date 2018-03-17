<?php

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\TaskFactory;
use Polidog\Chatwork\Entity\Task;

class TasksTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTasks
     * @param $apiResult
     */
    public function testShow($apiResult)
    {
        $roomId = 1;

        $client = $this->prophesize(ClientInterface::class);
        $client->request("GET","rooms/{$roomId}/tasks", [
            'query' => []
        ])->willReturn($apiResult);

        $factory = new TaskFactory();
        $api = new Tasks($roomId, $client->reveal(), $factory);
        $tasks = $api->show();
        $this->assertInstanceOf(EntityCollection::class, $tasks);
        foreach ($tasks as $task) {
            $this->assertInstanceOf(Task::class, $task);
        }

    }

    /**
     * @dataProvider providerTask
     * @param $apiResult
     */
    public function testDetail($apiResult)
    {
        $roomId = 1;
        $taskId = 11;

        $client = $this->prophesize(ClientInterface::class);
        $client->request("GET","rooms/{$roomId}/tasks/{$taskId}")->willReturn($apiResult);

        $factory = new TaskFactory();
        $api = new Tasks($roomId, $client->reveal(), $factory);
        $task = $api->detail($taskId);
        $this->assertInstanceOf(Task::class, $task);


    }


    public function providerTasks()
    {
        $data = json_decode('[
  {
    "task_id": 3,
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
  }
]', true);

        return [
            [$data]
        ];
    }

    public function providerTask()
    {
        $data = json_decode('{
  "task_id": 3,
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
}', true);

        return [
            [$data]
        ];
    }

//    /**
//     * @test
//     */
//    public function タスクを登録する()
//    {
//        $collection = new EntityCollection();
//        $taskIds = [123, 456, 789];
//
//        $task1 = new Task();
//        $task1->body = 'task body';
//        $task1->limitTime = 1385996399;
//        $task1->account = new User();
//        $task1->account->accountId = 1;
//        $collection->add($task1);
//
//        $task2 = clone $task1;
//        $task2->account = new User();
//        $task2->account->accountId = 2;
//        $collection->add($task2);
//
//        $task3 = clone $task1;
//        $task3->account = new User();
//        $task3->account->accountId = 3;
//        $collection->add($task3);
//
//        $httpClient = Phake::mock(ClientInterface::class);
//        $response = Phake::mock(ResponseInterface::class);
//        $factory = Phake::mock(FactoryInterface::class);
//
//        Phake::when($httpClient)
//            ->post($this->isType('array'), $this->isType('array'))
//            ->thenReturn($response);
//
//        Phake::when($response)
//            ->json()
//            ->thenReturn([
//                'task_ids' => $taskIds,
//            ]);
//
//        $tasks = new Tasks(1, $httpClient, $factory);
//        $tasks->create($collection);
//
//        Phake::verify($httpClient, Phake::times(1))->post(
//            ['rooms/{roomId}/tasks', ['roomId' => 1]],
//            [
//                'body' => [
//                    'body' => 'task body',
//                    'to_ids' => '1,2,3',
//                    'limit' => 1385996399,
//                ],
//            ]
//        );
//
//        foreach ($taskIds as $key => $taskId) {
//            $this->assertEquals($taskId, $collection->get($key)->taskId);
//        }
//    }
}
