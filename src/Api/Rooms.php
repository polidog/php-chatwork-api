<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\Collection\MemberCollection;
use Polidog\Chatwork\Entity\Factory\FileFactory;
use Polidog\Chatwork\Entity\Factory\MemberFactory;
use Polidog\Chatwork\Entity\Factory\MessageFactory;
use Polidog\Chatwork\Entity\Factory\RoomFactory;
use Polidog\Chatwork\Entity\Factory\TaskFactory;
use Polidog\Chatwork\Entity\Room;
use Polidog\Chatwork\Exception\InvalidArgumentException;

class Rooms
{
    const ACTION_TYPE_LEAVE = 'leave';
    const ACTION_TYPE_DELETE = 'delete';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var RoomFactory
     */
    private $factory;

    /**
     * Rooms constructor.
     *
     * @param ClientInterface $client
     * @param RoomFactory     $factory
     */
    public function __construct(ClientInterface $client, RoomFactory $factory)
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    /**
     * 自分のチャット一覧の取得.
     *
     * @return CollectionInterface
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->get('rooms')
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
            $this->client->get("rooms/{$id}")
        );
    }

    /**
     * グループチャットを新規作成.
     *
     * @param Room             $room
     * @param MemberCollection $members
     *
     * @return Room
     */
    public function create(Room $room, MemberCollection $members)
    {
        $result = $this->client->post('rooms', [
            'name' => $room->name,
            'description' => $room->description,
            'members_admin_ids' => implode(',', $members->getAdminIds()),
            'members_member_ids' => implode(',', $members->getMemberIds()),
            'members_readonly_ids' => implode(',', $members->getReadonlyIds()),
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
        $this->client->put(
            "rooms/{$room->roomId}",
            [$room->toArray()]
        );
    }

    /**
     * グループチャットを退席/削除する.
     *
     * @param Room   $room
     * @param string $actionType leave or delete
     *
     * @throws InvalidArgumentException
     */
    public function remove(Room $room, $actionType)
    {
        if ('leave' !== $actionType && 'delete' !== $actionType) {
            throw new InvalidArgumentException('ActionType is only leave or delete');
        }

        $this->client->delete(
            "rooms/{$room->roomId}",
            [
                'action_type' => $actionType,
            ]
        );
    }

    /**
     * @param $roomId
     *
     * @return Rooms\Members
     */
    public function members(int $roomId)
    {
        return new Rooms\Members($this->client, new MemberFactory(), $roomId);
    }

    /**
     * @param $roomId
     *
     * @return Rooms\Messages
     */
    public function messages(int $roomId)
    {
        return new Rooms\Messages($this->client, new MessageFactory(), $roomId);
    }

    /**
     * @param $roomId
     *
     * @return Rooms\Tasks
     */
    public function tasks(int $roomId)
    {
        return new Rooms\Tasks($this->client, new TaskFactory(), $roomId);
    }

    /**
     * @param int $roomId
     *
     * @return Rooms\Files
     */
    public function files(int $roomId)
    {
        return new Rooms\Files($this->client, new FileFactory(), $roomId);
    }
}
