<?php
namespace Polidog\Chatwork\Api\My;

use Polidog\Chatwork\Api\AbstractApi;
use Polidog\Chatwork\Collection\CollectionInterface;

class Tasks extends AbstractApi
{
    /**
     * @param array $options
     * @return CollectionInterface
     */
    public function show(array $options = [])
    {
        return $this->factory->collection(
            $this->client->get('my/tasks',['query' => $options])
        );
    }
}