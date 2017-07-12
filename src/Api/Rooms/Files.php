<?php

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\ClientInterface;
use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;
use Polidog\Chatwork\Entity\Factory\FileFactory;
use Polidog\Chatwork\Entity\File;

/**
 * Class Files.
 *
 * @property FileFactory $factory
 */
class Files extends AbstractRoomApi
{
    public function __construct($roomId, ClientInterface $client, FactoryInterface $factory = null)
    {
        assert($factory instanceof FileFactory);
        parent::__construct($roomId, $client, $factory);
    }


    /**
     * @param null $accountId
     *
     * @return CollectionInterface
     */
    public function show($accountId = null)
    {
        $options = [
            'query' => [],
        ];

        if (!is_null($accountId)) {
            $options['query']['account_id'] = $accountId;
        }

        return $this->factory->collection(
            $this->client->request(
                'GET',
                "rooms/{$this->roomId}/files",
                $options
            )
        );
    }

    /**
     * @param $id
     *
     * @return File
     */
    public function detail($id)
    {
        return $this->factory->entity(
          $this->client->request(
              'GET',
              "rooms/{$this->roomId}/files/{$id}"
          )
        );
    }
}
