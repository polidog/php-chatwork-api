<?php
namespace Polidog\Chatwork\Api\Rooms;


use Polidog\Chatwork\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\Message;

/**
 * Class Messages
 * @package Polidog\Chatwork\Api\Rooms
 */
class Messages extends AbstractRoomApi 
{
    /**
     * @param bool $force
     * @return CollectionInterface
     */
    public function show($force = false)
    {
        return $this->factory->collection(
            $this->client->get(
                ['rooms/{roomId}/messages',['roomId' => $this->roomId]],
                [
                    'query' => [
                        'force' => (int)$force
                    ]
                ]
            )->json()
        );
    }

    /**
     * @param $id
     * @param bool $force
     * @return Message
     */
    public function detail($id, $force = false)
    {
        return $this->factory->entity(
            $this->client->get(
                ['rooms/{roomId}/messages/{id}',
                    [
                        'roomId' => $this->roomId,
                        'id' => $id
                    ]
                ],
                [
                    'query' => [
                        'force' => (int)$force
                    ]
                ]
            )->json()
        );        
    }
}