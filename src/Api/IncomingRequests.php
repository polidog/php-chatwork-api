<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;
use Polidog\Chatwork\Entity\Factory\IncomingRequestsFactory;

class IncomingRequests extends AbstractApi
{
    public function __construct(ClientInterface $client, FactoryInterface $factory = null)
    {
        assert($factory instanceof IncomingRequestsFactory);
        parent::__construct($client, $factory);
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

    public function reject($requestId)
    {
        $this->client->delete("incoming_requests/{$requestId}");
    }
}
