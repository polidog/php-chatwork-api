<?php

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Collection\MembersCollection;
use Polidog\Chatwork\Entity\Factory\FileFactory;
use Polidog\Chatwork\Entity\Factory\MemberFactory;
use Polidog\Chatwork\Entity\Factory\MessageFactory;
use Polidog\Chatwork\Entity\Factory\TaskFactory;
use Polidog\Chatwork\Entity\Room;

class Rooms extends AbstractApi
{
    const ACTION_TYPE_LEAVE = 'leave';
    const ACTION_TYPE_DELETE = 'delete';

    /**
     * 自分のチャット一覧の取得.
     *
     * @return EntityCollection
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->request('GET', 'rooms')
        );
    }

    /**
     * @param $id
     *
     * @return Room
     */
    public function detail($id)
    {
        return $this->factory->entity(
            $this->client->request('GET', "rooms/{$id}")
        );
    }

    /**
     * グループチャットを新規作成.
     *
     * @param Room              $room
     * @param MembersCollection $members
     *
     * @return Room
     */
    public function create(Room $room, MembersCollection $members)
    {
        $result = $this->client->request('POST', 'rooms', [
            'form_params' => [
                'name' => $room->name,
                'description' => $room->description,
                'members_admin_ids' => implode(',', $members->getAdminIds()),
                'members_member_ids' => implode(',', $members->getMemberIds()),
                'members_readonly_ids' => implode(',', $members->getReadonlyIds()),
            ],
        ]);
        $room->roomId = $result['room_id'];

        return $room;
    }

    /**
     * チャットの名前、アイコンをアップデート.
     *
     * @param Room $room
     */
    public function update(Room $room)
    {
        $this->client->request(
            'put',
            "rooms/{$room->roomId}",
            ['form_params' => $room->toArray()]
        );
    }

    /**
     * グループチャットを退席/削除する.
     *
     * @param Room   $room
     * @param string $actionType
     */
    public function remove(Room $room, $actionType)
    {
        $this->client->request(
            'delete',
            "rooms/{$room->roomId}",
            [
                'query' => [
                    'action_type' => $actionType,
                ],
            ]
        );
    }

    /**
     * @param $roomId
     *
     * @return Rooms\Members
     */
    public function members($roomId)
    {
        return new Rooms\Members($roomId, $this->client, new MemberFactory());
    }

    /**
     * @param $roomId
     *
     * @return Rooms\Messages
     */
    public function messages($roomId)
    {
        return new Rooms\Messages($roomId, $this->client, new MessageFactory());
    }

    /**
     * @param $roomId
     *
     * @return Rooms\Tasks
     */
    public function tasks($roomId)
    {
        return new Rooms\Tasks($roomId, $this->client, new TaskFactory());
    }

    /**
     * @param $roomId
     *
     * @return Rooms\Files
     */
    public function files($roomId)
    {
        return new Rooms\Files($roomId, $this->client, new FileFactory());
    }
}
