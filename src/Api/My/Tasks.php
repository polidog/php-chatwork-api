<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\My;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\Factory\TaskFactory;

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
     * Tasks constructor.
     *
     * @param ClientInterface $client
     * @param TaskFactory     $factory
     */
    public function __construct(ClientInterface $client, TaskFactory $factory)
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    /**
     * @param array $options
     *
     * @return CollectionInterface
     */
    public function show(array $options = [])
    {
        return $this->factory->collection(
            $this->client->get('my/tasks', $options)
        );
    }
}
