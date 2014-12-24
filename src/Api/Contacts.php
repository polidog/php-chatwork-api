<?php
namespace Polidog\Chatwork\Api;

/**
 * Api Contacts
 * @package Polidog\Chatwork\Api
 */
class Contacts extends AbstractApi 
{
    /**
     * @return \Polidog\Chatwork\Collection\CollectionInterface
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->get('contacts')->json()
        );
    }
}