<?php
namespace Polidog\Chatwork\Api;


use Polidog\Chatwork\Entity\Factory\MemberFactory;
use Polidog\Chatwork\Entity\Room;

class Rooms extends AbstractApi
{
    const ACTION_TYPE_LEAVE = 'leave';
    const ACTION_TYPE_DELETE = 'delete';
    
    
    /**
     * 自分のチャット一覧の取得
     * @param int $id
     *
     * @return array
     */
    public function show($id = null)
    {
        if (is_null($id)) {
            return $this->factory->collection(
                $this->client->get('rooms')->json()
            );
        }
        return $this->factory->entity(
            $this->client->get(['rooms/{id}',['id' => $id]])->json()
        );
    }
    
    /**
     * グループチャットを新規作成
     * 
     * @param Room $room
     * @return Room
     */
    public function create(Room $room)
    {
        $result = $this->client->post('rooms',[
            'body' => $room->toArray()
        ])->json();
        $room->roomId = $result['room_id'];
        return $room;
    }

    /**
     * チャットの名前、アイコンをアップデート
     * @param $id room id
     * @param array $options
     *
     * @return void
     */
    public function update(Room $room)
    {
        $this->client->put(
            ['rooms/{id}',['id' => $room->roomId]],
            ['body' => $room->toArray()]
        );
    }

    /**
     * グループチャットを退席/削除する
     * @param int $id room id
     * @param string $actionType
     * 
     * @return void
     */
    public function remove(Room $room, $actionType)
    {
        $this->client->delete(
            ['rooms/{id}',['id' => $room->roomId]],
            [
                'query' => [
                    'action_type' => $actionType
                ]
            ]
        );
    }

    /**
     * @param $id
     * @return Rooms\Members
     */
    public function members($id)
    {
        return new Rooms\Members($id, $this->client, new MemberFactory());
    }
  
}