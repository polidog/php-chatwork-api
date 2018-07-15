<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

/**
 * Api Contacts.
 */
class Contacts extends AbstractApi
{
    /**
     * @return \Polidog\Chatwork\Entity\Collection\CollectionInterface
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->get('contacts')
        );
    }
}
