<?php
namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Entity\Collection\MembersCollection;

/**
 * Class Members
 * @package Polidog\Chatwork\Api\Rooms
 */
class Members extends AbstractRoomApi 
{
    /**
     * @return MembersCollection
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->get(
                ['rooms/{roomId}/members',['roomId' => $this->roomId]]
            )->json()
        );
    }

    /**
     * @param MembersCollection $members
     */
    public function update(MembersCollection $members)
    {
        $options = [
            'body' => [
                'members_admin_ids' => implode(',',$members->getAdminIds()),
                'members_member_ids' => implode(',',$members->getMemberIds()),
                'members_readonly_ids' => implode(',',$members->getReadonlyIds())
            ]
        ];
        $this->client->put(['rooms/{roomId}/members',['roomId' => $this->roomId]], $options);
    }
}