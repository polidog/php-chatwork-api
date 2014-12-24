<?php
namespace Polidog\Chatwork\Entity\Factory;


use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Entity\Member;
use Polidog\Chatwork\Entity\User;

class MemberFactory extends AbstractFactory
{
    /**
     * @param array $data
     * @return Member
     */
    public function entity(array $data = [])
    {
        $member = new Member();
        $member->role = $data['role'];
        unset($data['role']);
        
        // @todo ここでFactoryオブジェクトを生成するのをなんとかしたい...
        $userFactory = new UserFactory();
        $member->user = $userFactory->entity($data);
        return $member;
    }
}