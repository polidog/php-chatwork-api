<?php
namespace Polidog\Chatwork\Api\Rooms;


use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\EntityInterface;
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
            $this->client->request(
                "GET",
                "rooms/{$this->roomId}/messages",
                [
                    'query' => [
                        'force' => (int)$force
                    ]
                ]
            )
        );
    }

    /**
     * @param $id
     * @param bool $force
     * @return Message|EntityInterface
     */
    public function detail($id, $force = false)
    {
        return $this->factory->entity(
            $this->client->request(
                "GET",
                "rooms/{$this->roomId}/messages/{$id}",
                [
                    'query' => [
                        'force' => (int)$force
                    ]
                ]
            )
        );        
    }

    /**
     * @param Message $message
     */
    public function create(Message $message)
    {
        $result = $this->client->request(
            "POST",
            "rooms/{$this->roomId}/messages",
            [
                'form_params' => [
                    'body' => $message->body
                ]
            ]
        );
        
        $message->messageId = $result['message_id'];
    }
    
}
