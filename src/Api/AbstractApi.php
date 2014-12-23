<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 1:42
 */

namespace Polidog\Chatwork\Api;

use GuzzleHttp\ClientInterface;

abstract class AbstractApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}