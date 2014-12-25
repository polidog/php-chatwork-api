<?php
namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Entity\User;

/**
 * Api /me 
 * @package Polidog\Chatwork\Api
 */
class Me extends AbstractApi 
{
    /**
     * @return User
     */
    public function show()
    {
        return $this->factory->entity(
            $this->client->get('me')->json()
        );
    }
}