<?php

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Entity\Collection\MembersCollection;

/**
 * Class Members.
 */
class Members extends AbstractRoomApi
{
    /**
     * @return MembersCollection
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->request(
                'GET',
                "rooms/{$this->roomId}/members"
            )
        );
    }

    /**
     * @param MembersCollection $members
     */
    public function update(MembersCollection $members)
    {
        $options = [
            'form_params' => [
                'members_admin_ids' => implode(',', $members->getAdminIds()),
                'members_member_ids' => implode(',', $members->getMemberIds()),
                'members_readonly_ids' => implode(',', $members->getReadonlyIds()),
            ],
        ];
        $this->client->request('PUT', "rooms/{$this->roomId}/members", $options);
    }
}
