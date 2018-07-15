<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\UserFactory;

/**
 * Api Contacts.
 */
class Contacts
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var UserFactory
     */
    private $factory;

    /**
     * Contacts constructor.
     *
     * @param ClientInterface $client
     * @param UserFactory     $factory
     */
    public function __construct(ClientInterface $client, UserFactory $factory)
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    /**
     * @return \Polidog\Chatwork\Entity\Collection\CollectionInterface
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->get('contacts')
        );
    }
}
