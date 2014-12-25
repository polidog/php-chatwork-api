<?php
namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\Task;

class Tasks extends AbstractRoomApi
{

    /**
     * @param array $options
     * @return CollectionInterface
     */
    public function show(array $options = [])
    {
        return $this->factory->collection(
            $this->client->get(
                ['rooms/{roomId}/tasks',['roomId' => $this->roomId]],
                [
                    'query' => $options
                ]
            )->json()
        );
    }

    /**
     * @param int $id
     * @return Task
     */
    public function detail($id)
    {
        return $this->factory->entity(
            $this->client->get(
                ['rooms/{roomId}/tasks/{id}',
                    [
                        'roomId' => $this->roomId,
                        'id' => $id
                    ],
                ]
            )->json()
        );
    }
    
    /**
     * @param CollectionInterface $collection
     */
    public function create(CollectionInterface $collection)
    {
        $toIds = [];
        foreach ($collection as $entity) {
            $toIds[] = $entity->account->accountId;
        }
        
        $task = clone $collection->get(0);
        $results = $this->client->post(
            ['rooms/{roomId}/tasks', ['roomId' => $this->roomId]],
            [
                'body' => [
                    'body' => $task->body,
                    'to_ids' => implode(',',$toIds),
                    'limit' => $task->limitTime,
                ]
            ]
        )->json();
        
        foreach ($results['task_ids'] as $key => $id) {
            $collection->get($key)->taskId = $id;
        }
        
    }
}