<?php

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;

abstract class AbstractRoomApi
{
    /**
     * @var int
     */
    protected $roomId;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @param int              $roomId
     * @param ClientInterface  $client
     * @param FactoryInterface $factory
     */
    public function __construct($roomId, ClientInterface $client, FactoryInterface $factory = null)
    {
        $this->roomId = $roomId;
        $this->client = $client;
        $this->factory = $factory;
    }
}
