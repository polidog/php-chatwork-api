<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 5:50.
 */

namespace Polidog\Chatwork\Api;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\UserFactory;
use Polidog\Chatwork\Entity\User;
use Prophecy\PhpUnit\ProphecyTrait;

class ContactsTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerResponseData
     */
    public function testShow($apiResult): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->get('contacts')
            ->willReturn($apiResult);

        $factory = new UserFactory();
        $contacts = new Contacts($client->reveal(), $factory);
        $users = $contacts->show();
        $this->assertInstanceOf(EntityCollection::class, $users);
        foreach ($users as $user) {
            $this->assertInstanceOf(User::class, $user);
        }
    }

    public function providerResponseData()
    {
        $data = json_decode('[
  {
    "account_id": 123,
    "room_id": 322,
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
}
