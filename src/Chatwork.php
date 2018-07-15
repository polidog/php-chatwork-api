<?php

declare(strict_types=1);

namespace Polidog\Chatwork;

use Polidog\Chatwork\Api\Contacts;
use Polidog\Chatwork\Api\Me;
use Polidog\Chatwork\Api\My;
use Polidog\Chatwork\Api\Rooms;
use Polidog\Chatwork\Client\ClientFactory;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\RoomFactory;
use Polidog\Chatwork\Entity\Factory\UserFactory;

class Chatwork
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Chatwork constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function me(): Me
    {
        return new Api\Me($this->client, new UserFactory());
    }

    public function my(): My
    {
        return new Api\My($this->client);
    }

    public function contacts(): Contacts
    {
        return new Api\Contacts($this->client, new UserFactory());
    }

    public function rooms(): Rooms
    {
        return new Api\Rooms($this->client, new RoomFactory());
    }

    public static function create(string $token, string $version = 'v2', array $httpOptions = []): self
    {
        return new self(ClientFactory::create($token, $version, $httpOptions));
    }
}
