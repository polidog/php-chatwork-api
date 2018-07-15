<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\UserFactory;
use Polidog\Chatwork\Entity\User;

/**
 * Api /me.
 */
class Me
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
     * Me constructor.
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
     * @return User
     */
    public function show(): User
    {
        return $this->factory->entity(
            $this->client->get('me')
        );
    }
}
