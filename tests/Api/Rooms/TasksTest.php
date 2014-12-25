<?php
namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;

use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\ClientInterface;

use Phake;
use Polidog\Chatwork\Entity\Task;
use Polidog\Chatwork\Entity\User;


class TasksTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function タスク一覧を取得する()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);
        $factory = Phake::mock(FactoryInterface::class);
        
        Phake::when($httpClient)
            ->get($this->isType('array'),$this->isType('array'))
            ->thenReturn($response);
        
        Phake::when($response)
            ->json()
            ->thenReturn([]);
        
        $tasks = new Tasks(1, $httpClient, $factory);
        $tasks->show();
        
        Phake::verify($httpClient)->get(
            ['rooms/{roomId}/tasks',['roomId' => 1]],
            $this->isType('array')
        );
        
        Phake::verify($response)
            ->json();
        
        Phake::verify($factory)
            ->collection($this->isType('array'));
            
    }

    /**
     * @test
     */
    public function IDを指定してタスクを取得する()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);
        $factory = Phake::mock(FactoryInterface::class);

        Phake::when($httpClient)
            ->get($this->isType('array'))
            ->thenReturn($response);

        Phake::when($response)
            ->json()
            ->thenReturn([]);

        $tasks = new Tasks(1, $httpClient, $factory);
        $tasks->detail(123456);

        Phake::verify($httpClient)->get(
            ['rooms/{roomId}/tasks/{id}',['roomId' => 1,'id' => 123456]]
        );

        Phake::verify($response)
            ->json();

        Phake::verify($factory)
            ->entity($this->isType('array'));        
    }

    /**
     * @test
     */
    public function タスクを登録する()
    {
        $collection = new EntityCollection();
        $taskIds = [123,456,789];
        
        $task1 = new Task();
        $task1->body = "task body";
        $task1->limitTime = 1385996399;
        $task1->account = new User();
        $task1->account->accountId = 1;
        $collection->add($task1);
        
        $task2 = clone $task1;
        $task2->account = new User();
        $task2->account->accountId = 2;
        $collection->add($task2);

        $task3 = clone $task1;
        $task3->account = new User();
        $task3->account->accountId = 3;
        $collection->add($task3);

        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);
        $factory = Phake::mock(FactoryInterface::class);

        Phake::when($httpClient)
            ->post($this->isType('array'),$this->isType('array'))
            ->thenReturn($response);

        Phake::when($response)
            ->json()
            ->thenReturn([
                'task_ids' => $taskIds
            ]);

        $tasks = new Tasks(1, $httpClient, $factory);
        $tasks->create($collection);
        
        Phake::verify($httpClient,Phake::times(1))->post(
            ['rooms/{roomId}/tasks',['roomId' => 1]],
            [
                'body' => [
                    'body' => 'task body',
                    'to_ids' => '1,2,3',
                    'limit' => 1385996399                    
                ]
            ]
        );
        
        foreach ($taskIds as $key => $taskId) {
            $this->assertEquals($taskId, $collection->get($key)->taskId);
        }
        
    }
}