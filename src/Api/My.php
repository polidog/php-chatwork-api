<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Api\My\Status;
use Polidog\Chatwork\Api\My\Tasks;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\StatusFactory;
use Polidog\Chatwork\Entity\Factory\TaskFactory;

/**
 * Api /my.
 */
class My
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * M constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return Status
     */
    public function status(): Status
    {
        return new My\Status($this->client, new StatusFactory());
    }

    /**
     * @param array $options
     *
     * @return Tasks
     */
    public function tasks(array $options = []): Tasks
    {
        return new My\Tasks($this->client, new TaskFactory());
    }
}
