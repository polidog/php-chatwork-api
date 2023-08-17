<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\MemberCollection;
use Polidog\Chatwork\Entity\Factory\MemberFactory;

/**
 * Class Members.
 */
class Members
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var MemberFactory
     */
    private $factory;

    /**
     * @var int
     */
    private $roomId;

    /**
     * Members constructor.
     *
     * @param ClientInterface $client
     * @param MemberFactory   $factory
     * @param int             $roomId
     */
    public function __construct(ClientInterface $client, MemberFactory $factory, int $roomId)
    {
        $this->client = $client;
        $this->factory = $factory;
        $this->roomId = $roomId;
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
    public function update(MemberCollection $members): void
    {
        $options = [
            'members_admin_ids' => implode(',', $members->getAdminIds()),
            'members_member_ids' => implode(',', $members->getMemberIds()),
            'members_readonly_ids' => implode(',', $members->getReadonlyIds()),
        ];
        $this->client->put("rooms/{$this->roomId}/members", $options);
    }
}
