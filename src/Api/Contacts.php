<?php

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
            $this->client->request('GET', 'contacts')
        );
    }
}
