<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

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
            $this->client->get('me')
        );
    }
}
