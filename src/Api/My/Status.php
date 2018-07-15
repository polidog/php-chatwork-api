<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\My;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\StatusFactory;

class Status
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var StatusFactory
     */
    private $factory;

    /**
     * Status constructor.
     *
     * @param ClientInterface $client
     * @param StatusFactory   $factory
     */
    public function __construct(ClientInterface $client, StatusFactory $factory)
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    public function show()
    {
        return $this->factory->entity(
            $this->client->get('my/status')
        );
    }
}
