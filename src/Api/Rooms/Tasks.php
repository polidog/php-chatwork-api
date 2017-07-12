<?php
namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Entity\Collection\CollectionInterface;
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
            $this->client->request(
                "GET",
                "rooms/{$this->roomId}/tasks",
                [
                    'query' => $options
                ]
            )
        );
    }

    /**
     * @param int $id
     * @return Task
     */
    public function detail($id)
    {
        return $this->factory->entity(
            $this->client->request(
                "GET",
                "rooms/{$this->roomId}/tasks/{$id}"
            )
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
            "post",
            "rooms/{$this->roomId}/tasks",
            [
                'form_params' => [
                    'body' => $task->body,
                    'to_ids' => implode(',',$toIds),
                    'limit' => $task->limitTime,
                ]
            ]
        );
        
        foreach ($results['task_ids'] as $key => $id) {
            $collection->get($key)->taskId = $id;
        }

    }
}
