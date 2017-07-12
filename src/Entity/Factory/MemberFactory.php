<?php

namespace Polidog\Chatwork\Entity\Factory;

use Polidog\Chatwork\Entity\Collection\MembersCollection;
use Polidog\Chatwork\Entity\Member;

class MemberFactory extends AbstractFactory
{
    protected $collectionName = MembersCollection::class;

    /**
     * @param array $data
     *
     * @return Member
     */
    public function entity(array $data = [])
    {
        $member = new Member();
        $member->role = $data['role'];
        unset($data['role']);

        // @todo ここでFactoryオブジェクトを生成するのをなんとかしたい...
        $userFactory = new UserFactory();
        $member->account = $userFactory->entity($data);

        return $member;
    }
}
