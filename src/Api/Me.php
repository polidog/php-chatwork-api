<?php
namespace Polidog\Chatwork\Api;

/**
 * Api /me 
 * @package Polidog\Chatwork\Api
 */
class Me extends AbstractApi 
{
    /**
     * @return array
     */
    public function show()
    {
        return $this->client->get('me')->json();
    }
}