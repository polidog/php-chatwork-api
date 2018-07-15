<?php

namespace Polidog\Chatwork\Entity\Factory;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Entity\Member;
use Polidog\Chatwork\Entity\User;

class MemberFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testCreateEntity()
    {
        $factory = new MemberFactory();
        $entity = $factory->entity(json_decode('{
            "account_id": 123,
            "role": "member",
            "name": "John Smith",
            "chatwork_id": "tarochatworkid",
            "organization_id": 101,
            "organization_name": "Hello Company",
            "department": "Marketing",
            "avatar_image_url": "https://example.com/abc.png"
        }', true));

        $this->assertInstanceOf(Member::class, $entity);
        $this->assertInstanceOf(User::class, $entity->account);
        $this->assertEquals('member', $entity->role);
    }
}
