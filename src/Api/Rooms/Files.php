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
        $options = [
            'query' => []
        ];
        
        if (!is_null($accountId)) {
            $options['query']['account_id'] = $accountId;
        }
        
        return $this->factory->collection(
            $this->client->get(
                ['rooms/{roomId}/files',['roomId' => $this->roomId]],
                $options
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