<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\MemberCollection;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;
use Polidog\Chatwork\Entity\Factory\MemberFactory;

/**
 * Class Members.
 */
class Members extends AbstractRoomApi
{
    public function __construct($roomId, ClientInterface $client, FactoryInterface $factory = null)
    {
        assert($factory instanceof MemberFactory);
        parent::__construct($roomId, $client, $factory);
    }

    /**
     * @return MemberCollection
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->get("rooms/{$this->roomId}/members")
        );
    }

    /**
     * @param MemberCollection $members
     */
    public function update(MemberCollection $members)
    {
        $options = [
            'members_admin_ids' => implode(',', $members->getAdminIds()),
            'members_member_ids' => implode(',', $members->getMemberIds()),
            'members_readonly_ids' => implode(',', $members->getReadonlyIds()),
        ];
        $this->client->put("rooms/{$this->roomId}/members", $options);
    }
}
