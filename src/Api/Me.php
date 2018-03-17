<?php

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Entity\User;

/**
 * Api /me.
 */
class Me extends AbstractApi
{
    /**
     * @return \Polidog\Chatwork\Entity\EntityInterface
     */
    public function show()
    {
        return $this->factory->entity(
            $this->client->get( 'me')
        );
    }
}
