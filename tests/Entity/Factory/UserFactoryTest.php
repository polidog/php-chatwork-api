<?php

namespace Polidog\Chatwork\Entity\Factory;

use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    public function testCreateUserEntity()
    {
        $factory = new UserFactory();
        $entity = $factory->entity(json_decode('{
            "account_id": 123,
            "room_id": 322,
            "name": "John Smith",
            "chatwork_id": "tarochatworkid",
            "organization_id": 101,
            "organization_name": "Hello Company",
            "department": "Marketing",
            "title": "CMO",
            "url": "http://mycompany.com",
            "introduction": "Self Introduction",
            "mail": "taro@example.com",
            "tel_organization": "XXX-XXXX-XXXX",
            "tel_extension": "YYY-YYYY-YYYY",
            "tel_mobile": "ZZZ-ZZZZ-ZZZZ",
            "skype": "myskype_id",
            "facebook": "myfacebook_id",
            "twitter": "mytwitter_id",
            "avatar_image_url": "https://example.com/abc.png"
        }', true));

        $this->assertEquals(123, $entity->accountId);
        $this->assertEquals(322, $entity->roomId);
        $this->assertEquals('John Smith', $entity->name);
        $this->assertEquals('tarochatworkid', $entity->chatworkId);
        $this->assertEquals(101, $entity->organizationId);
        $this->assertEquals('Hello Company', $entity->organizationName);
        $this->assertEquals('Marketing', $entity->department);
        $this->assertEquals('CMO', $entity->title);
        $this->assertEquals('http://mycompany.com', $entity->url);
        $this->assertEquals('Self Introduction', $entity->introduction);
        $this->assertEquals('taro@example.com', $entity->mail);
        $this->assertEquals('XXX-XXXX-XXXX', $entity->telOrganization);
        $this->assertEquals('YYY-YYYY-YYYY', $entity->telExtension);
        $this->assertEquals('ZZZ-ZZZZ-ZZZZ', $entity->telMobile);
        $this->assertEquals('myskype_id', $entity->skype);
        $this->assertEquals('myfacebook_id', $entity->facebook);
        $this->assertEquals('mytwitter_id', $entity->twitter);
        $this->assertEquals('https://example.com/abc.png', $entity->avatarImageUrl);
    }
}
