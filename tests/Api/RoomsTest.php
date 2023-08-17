<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Api\Rooms\Files;
use Polidog\Chatwork\Api\Rooms\Members;
use Polidog\Chatwork\Api\Rooms\Messages;
use Polidog\Chatwork\Api\Rooms\Tasks;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Collection\MemberCollection;
use Polidog\Chatwork\Entity\Factory\RoomFactory;
use Polidog\Chatwork\Entity\Member;
use Polidog\Chatwork\Entity\Room;
use Polidog\Chatwork\Entity\User;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * Class RoomsTest.
 */
class RoomsTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerRooms
     */
    public function testShow($apiResult): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->get('rooms')
            ->willReturn($apiResult);

        $factory = new RoomFactory();

        $rooms = new Rooms($client->reveal(), $factory);
        $roomLists = $rooms->show();

        $this->assertInstanceOf(EntityCollection::class, $roomLists);
        foreach ($roomLists as $room) {
            $this->assertInstanceOf(Room::class, $room);
        }

    }

    /**
     * @dataProvider providerRoom
     */
    public function testDetail($apiResult): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->get('rooms/1')
            ->willReturn($apiResult);

        $factory = new RoomFactory();
        $rooms = new Rooms($client->reveal(), $factory);
        $room = $rooms->detail(1);

        $this->assertInstanceOf(Room::class, $room);

    }

    public function testCreate(): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->post('rooms', Argument::any())
            ->willReturn([
                'room_id' => 1234,
            ]);

        $factory = new RoomFactory();
        $rooms = new Rooms($client->reveal(), $factory);

        $room = new Room();
        $room->name = "hoge";
        $room->description = "test";

        $members = new MemberCollection();
        $user = new User();
        $user->accountId = 1;
        $user->name = 'hoge';
        $member = new Member();
        $member->account = $user;
        $members->add($member);

        $rooms->create($room, $members);
        $this->assertEquals(1234, $room->roomId);
    }

    public function testUpdate(): void
    {
        $room = new Room();
        $room->roomId = 1234;
        $room->name = "test";

        $client = $this->prophesize(ClientInterface::class);
        $client->put("rooms/{$room->roomId}", [$room->toArray()])->willReturn([]);

        $factory = new RoomFactory();

        $rooms = new Rooms($client->reveal(), $factory);
        $rooms->update($room);

        $client->put("rooms/{$room->roomId}", [$room->toArray()])->shouldHaveBeenCalled();
    }

    public function testRemove(): void
    {
        $room = new Room();
        $room->roomId = 1234;
        $room->name = "test";

        $client = $this->prophesize(ClientInterface::class);
        $client->delete("rooms/{$room->roomId}", [
            'action_type' => Rooms::ACTION_TYPE_LEAVE
        ])->willReturn([]);

        $factory = new RoomFactory();

        $rooms = new Rooms($client->reveal(), $factory);
        $rooms->remove($room, Rooms::ACTION_TYPE_LEAVE);

        $client->delete("rooms/{$room->roomId}", [
            'action_type' => Rooms::ACTION_TYPE_LEAVE
        ])->shouldHaveBeenCalled();
    }

    public function testMembers(): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $factory = new RoomFactory();

        $rooms = new Rooms($client->reveal(), $factory);
        $members = $rooms->members(1);
        $this->assertInstanceOf(Members::class, $members);
    }

    public function testMessages(): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $factory = new RoomFactory();

        $rooms = new Rooms($client->reveal(), $factory);
        $members = $rooms->messages(1);
        $this->assertInstanceOf(Messages::class, $members);
    }

    public function testTasks(): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $factory = new RoomFactory();

        $rooms = new Rooms($client->reveal(), $factory);
        $tasks = $rooms->tasks(1);
        $this->assertInstanceOf(Tasks::class, $tasks);
    }

    public function testFiles(): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $factory = new RoomFactory();

        $rooms = new Rooms($client->reveal(), $factory);
        $files = $rooms->files(1);
        $this->assertInstanceOf(Files::class, $files);
    }


    public function providerRooms()
    {
        $data = json_decode('[
  {
    "room_id": 123,
    "name": "Group Chat Name",
    "type": "group",
    "role": "admin",
    "sticky": false,
    "unread_num": 10,
    "mention_num": 1,
    "mytask_num": 0,
    "message_num": 122,
    "file_num": 10,
    "task_num": 17,
    "icon_path": "https://example.com/ico_group.png",
    "last_update_time": 1298905200
  }
]', true);

        return [
            [$data]
        ];
    }

    public function providerRoom()
    {
        $data = json_decode('{
  "room_id": 123,
  "name": "Group Chat Name",
  "type": "group",
  "role": "admin",
  "sticky": false,
  "unread_num": 10,
  "mention_num": 1,
  "mytask_num": 0,
  "message_num": 122,
  "file_num": 10,
  "task_num": 17,
  "icon_path": "https://example.com/ico_group.png",
  "last_update_time": 1298905200,
  "description": "room description text"
}', true);

        return [
            [$data]
        ];
    }

}
