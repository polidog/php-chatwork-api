<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Entity\Factory\MessageFactory;
use Polidog\Chatwork\Entity\Message;

/**
 * Class Messages.
 */
class Messages
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var MessageFactory
     */
    private $factory;

    /**
     * @var int
     */
    private $roomId;

    /**
     * Messages constructor.
     *
     * @param ClientInterface $client
     * @param MessageFactory  $factory
     * @param int             $roomId
     */
    public function __construct(ClientInterface $client, MessageFactory $factory, int $roomId)
    {
        $this->client = $client;
        $this->factory = $factory;
        $this->roomId = $roomId;
    }

    /**
     * @param bool $force
     *
     * @return CollectionInterface
     */
    public function show($force = false)
    {
        return $this->factory->collection(
            $this->client->get(
                "rooms/{$this->roomId}/messages",
                [
                    'force' => (int) $force,
                ]
            )
        );
    }

    /**
     * @param $id
     * @param bool $force
     *
     * @return Message|EntityInterface
     */
    public function detail($id, $force = false)
    {
        return $this->factory->entity(
            $this->client->get(
                "rooms/{$this->roomId}/messages/{$id}",
                [
                    'force' => (int) $force,
                ]
            )
        );
    }

    /**
     * @param Message $message
     */
    public function create(Message $message)
    {
        $result = $this->client->post(
            "rooms/{$this->roomId}/messages",
            [
                'body' => $message->body,
            ]
        );

        $message->messageId = $result['message_id'];
    }
}
