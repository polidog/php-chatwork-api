<?php

namespace Chatwork\Api;
use Chatwork\Client;
use Chatwork\Exception\NoSupportApiException;

/**
 * Class ApiAbstract
 *
 * @package Chatwork\Api
 */
abstract class ApiAbstract implements ApiInterface
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 存在しないメソッドをコールする
     * @param $name
     * @param $args
     *
     * @throws \Chatwork\Exception\NoSupportApiException
     */
    public function __call($name, $args)
    {
        throw new NoSupportApiException('no support api name:'. $name);
    }

    public function get($path, array $parameters = array(), $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->get($path, $parameters, $requestHeaders);
        return $response->getContent();
    }

    public function post($path, array $parameters = array(), $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->post($path, $parameters, $requestHeaders);
        return $response->getContent();
    }


    public function put($path, array $parameters = array(), $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->put($path, $parameters, $requestHeaders);
        return $response->getContent();
    }

    public function delete($path, array $parameters = array(), $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->delete($path, $parameters, $requestHeaders);
        return $response->getContent();
    }
}