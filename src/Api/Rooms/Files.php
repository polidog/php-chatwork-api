<?php
namespace Polidog\Chatwork\Api\Rooms;


use Polidog\Chatwork\Entity\Collection\CollectionInterface;

class Files extends AbstractRoomApi 
{
    /**
     * @param null $accountId
     * @return CollectionInterface
     */
    public function show($accountId = null)
    {
        return $this->factory->collection(
            $this->client->get(
                ['rooms/{roomId}/files',['roomId' => $this->roomId]],
                [
                    'query' => [
                        'account_id' => $accountId
                    ]
                ]
            )->json()
        );
    }

    /**
     * @param $id
     * @return File
     */
    public function detail($id)
    {
        return $this->factory->entity(
          $this->client->get(
              ['rooms/{roomId}/files/{id}',[
                  'roomId' => $this->roomId,
                  'id' => $id
              ]]
          )->json()  
        );
    }
}