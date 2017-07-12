<?php

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Entity\User;

/**
 * Api /me.
 */
class Me extends AbstractApi
{
    /**
     * @return User
     */
    public function show()
    {
        return $this->factory->entity(
            $this->client->request('GET', 'me')
        );
    }
}
