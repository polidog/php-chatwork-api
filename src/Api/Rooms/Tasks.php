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
     * @param string $body
     * @param array $toIds
     * @param \DateTime|null $limit
     * @return int[] task ids
     */
    public function create(string $body, array $toIds, \DateTime $limit = null) : array
    {
        return $this->client->post(
            "rooms/{$this->roomId}/tasks",
            [
                'body' => $body,
                'to_ids' => implode(',', $toIds),
                'limit' => $limit instanceof \DateTime ? $limit->getTimestamp() : null,
            ]
        );
    }
}
