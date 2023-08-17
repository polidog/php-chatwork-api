<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\IncomingRequestsFactory;

class IncomingRequests
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var IncomingRequestsFactory
     */
    private $factory;

    /**
     * IncomingRequests constructor.
     *
     * @param ClientInterface         $client
     * @param IncomingRequestsFactory $factory
     */
    public function __construct(ClientInterface $client, IncomingRequestsFactory $factory)
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    public function show()
    {
        return $this->factory->collection(
            $this->client->get('incoming_requests')
        );
    }

    public function accept($requestId)
    {
        return $this->factory->entity(
            $this->client->put("incoming_requests/{$requestId}")
        );
    }

    public function reject($requestId): void
    {
        $this->client->delete("incoming_requests/{$requestId}");
    }
}
