<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 1:42
 */

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\ClientInterface;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;

/**
 * Class AbstractApi
 * @package Polidog\Chatwork\Api
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
     * @param ClientInterface $client
     * @param FactoryInterface $factory
     */
    public function __construct(ClientInterface $client, FactoryInterface $factory = null)
    {
        $this->client = $client;
        $this->factory = $factory;
    }
}
