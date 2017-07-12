<?php

namespace Polidog\Chatwork\Entity\Factory;

use Polidog\Chatwork\Entity\Collection\MemberCollection;
use Polidog\Chatwork\Entity\Member;

class MemberFactory extends AbstractFactory
{
    protected $collectionName = MemberCollection::class;

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
