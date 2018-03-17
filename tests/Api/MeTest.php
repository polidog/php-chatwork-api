<?php

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\UserFactory;
use Polidog\Chatwork\Entity\User;

class MeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerResponseData
     */
    public function testShow($apiResult)
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->request("GET",'me')
            ->willReturn($apiResult);

        $factory = new UserFactory();
        $me = new Me($client->reveal(), $factory);
        $user = $me->show();

        $this->assertInstanceOf(User::class, $user);
    }

    public function providerResponseData()
    {
        $data = json_decode('{
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
                }', true);

        return [
            [$data]
        ];
    }
}
