<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\Factory\TaskFactory;
use Polidog\Chatwork\Entity\Task;

class Tasks
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var TaskFactory
     */
    private $factory;

    /**
     * @var int
     */
    private $roomId;

    /**
     * Tasks constructor.
     *
     * @param ClientInterface $client
     * @param TaskFactory     $factory
     * @param int             $roomId
     */
    public function __construct(ClientInterface $client, TaskFactory $factory, int $roomId)
    {
        $this->client = $client;
        $this->factory = $factory;
        $this->roomId = $roomId;
    }

    /**
     * @param array $options
     *
     * @return CollectionInterface
     */
    public function show(array $options = [])
    {
        return $this->factory->collection(
            $this->client->get(
                "rooms/{$this->roomId}/tasks",
                $options
            )
        );
    }

    /**
     * @param int $id
     *
     * @return Task
     */
    public function detail($id)
    {
        return $this->factory->entity(
            $this->client->get(
                "rooms/{$this->roomId}/tasks/{$id}"
            )
        );
    }

    /**
     * @TODO api見直し
     *
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
            "rooms/{$this->roomId}/tasks",
            [
                'body' => $task->body,
                'to_ids' => implode(',', $toIds),
                'limit' => $task->limitTime,
            ]
        );

        foreach ($results['task_ids'] as $key => $id) {
            $collection->get($key)->taskId = $id;
        }
    }
}
