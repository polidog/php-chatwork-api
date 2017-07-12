<?php
namespace Polidog\Chatwork\Api\Rooms;


use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\Factory\FileFactory;
use Polidog\Chatwork\Entity\File;

/**
 * Class Files
 * @package Polidog\Chatwork\Api\Rooms
 *
 * @property FileFactory $factory
 */
class Files extends AbstractRoomApi 
{
    /**
     * @param null $accountId
     * @return CollectionInterface
     */
    public function show($accountId = null)
    {
        $options = [
            'query' => []
        ];
        
        if (!is_null($accountId)) {
            $options['query']['account_id'] = $accountId;
        }
        
        return $this->factory->collection(
            $this->client->request(
                "GET",
                "rooms/{$this->roomId}/files",
                $options
            )
        );
    }

    /**
     * @param $id
     * @return File
     */
    public function detail($id)
    {
        return $this->factory->entity(
          $this->client->request(
              "GET",
              "rooms/{$this->roomId}/files/{$id}"
          )
        );
    }
}
