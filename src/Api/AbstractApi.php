<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;

/**
 * Class AbstractApi.
 */
abstract class AbstractApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @param ClientInterface  $client
     * @param FactoryInterface $factory
     */
    public function __construct(ClientInterface $client, FactoryInterface $factory = null)
    {
        $this->client = $client;
        $this->factory = $factory;
    }
}
