<?php

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\ClientInterface;
use Polidog\Chatwork\Entity\Collection\MemberCollection;
use Polidog\Chatwork\Entity\Factory\MemberFactory;
use Polidog\Chatwork\Entity\Member;
use Polidog\Chatwork\Entity\User;
use Phake;

class MembersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerMembers
     */
    public function testShow($apiResults)
    {
        $roomId = 1;

        $client = $this->prophesize(ClientInterface::class);
        $client->request('GET', "rooms/{$roomId}/members")
            ->willReturn($apiResults);

        $memberFactory = new MemberFactory();
        $api = new Members($roomId, $client->reveal(), $memberFactory);
        $members = $api->show();
        $this->assertInstanceOf(MemberCollection::class, $members);
    }

    /**
     * @dataProvider providerPutMembers
     */
    public function testUpdate($apiResult)
    {
        $roomId = 1;

        $client = $this->prophesize(ClientInterface::class);

        $memberFactory = new MemberFactory();
        $api = new Members($roomId, $client->reveal(), $memberFactory);

        $members = $this->getMembers();
        $api->update($members);

        $client->request('PUT', "rooms/{$roomId}/members",[
            'form_params' => [
                'members_admin_ids' => implode(',', $members->getAdminIds()),
                'members_member_ids' => implode(',', $members->getMemberIds()),
                'members_readonly_ids' => implode(',', $members->getReadonlyIds()),
            ]
        ])->shouldHaveBeenCalled();

    }

    public function providerMembers()
    {
        $data = json_decode('[
  {
    "account_id": 123,
    "role": "member",
    "name": "John Smith",
    "chatwork_id": "tarochatworkid",
    "organization_id": 101,
    "organization_name": "Hello Company",
    "department": "Marketing",
    "avatar_image_url": "https://example.com/abc.png"
  }
]', true);

        return [
            [$data]
        ];
    }

    public function providerPutMembers()
    {
        $data = json_decode('{
  "admin": [1,11],
  "member": [2,22],
  "readonly": [3,33]
}', true);

        return [
            [$data]
        ];
    }

    private function getMembers()
    {
        $members = new MemberCollection();

        $member1 = new Member();
        $member1->role = 'admin';
        $member1->account = new User();
        $member1->account->accountId = 1;
        $members->add($member1);

        $member11 = new Member();
        $member11->role = 'admin';
        $member11->account = new User();
        $member11->account->accountId = 11;
        $members->add($member11);

        $member2 = new Member();
        $member2->role = 'member';
        $member2->account = new User();
        $member2->account->accountId = 2;
        $members->add($member2);

        $member22 = new Member();
        $member22->role = 'member';
        $member22->account = new User();
        $member22->account->accountId = 22;
        $members->add($member22);

        $member3 = new Member();
        $member3->role = 'readonly';
        $member3->account = new User();
        $member3->account->accountId = 3;
        $members->add($member3);

        $member33 = new Member();
        $member33->role = 'readonly';
        $member33->account = new User();
        $member33->account->accountId = 33;
        $members->add($member33);

        return $members;

    }

}
