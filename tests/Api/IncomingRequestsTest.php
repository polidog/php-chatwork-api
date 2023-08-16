<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\IncomingRequestsFactory;
use Polidog\Chatwork\Entity\IncomingRequest;

class IncomingRequestsTest extends TestCase
{
    /**
     * @dataProvider providerIncomingRequests
     */
    public function testShow($apiResults): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $factory = new IncomingRequestsFactory();

        $client->get('incoming_requests')
            ->willReturn($apiResults);

        $api = new IncomingRequests($client->reveal(), $factory);
        $incomingRequests = $api->show();
        $this->assertInstanceOf(EntityCollection::class, $incomingRequests);
        foreach ($incomingRequests as $incomingRequest) {
            $this->assertInstanceOf(IncomingRequest::class, $incomingRequest);
        }

    }

    /**
     * @dataProvider providerIncomingRequestPut
     */
    public function testAccept($apiResults): void
    {
        $requestId = 1;

        $client = $this->prophesize(ClientInterface::class);
        $factory = new IncomingRequestsFactory();

        $client->put("incoming_requests/{$requestId}")
            ->willReturn($apiResults);

        $api = new IncomingRequests($client->reveal(), $factory);
        $incomingRequest = $api->accept($requestId);
        $this->assertInstanceOf(IncomingRequest::class, $incomingRequest);

    }

    public function providerIncomingRequests()
    {
        $data = json_decode('[
  {
    "request_id": 123,
    "account_id": 363,
    "message": "hogehoge",
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

    public function providerIncomingRequestPut()
    {
        $data = json_decode('{
  "account_id": 363,
  "room_id": 1234,
  "name": "John Smith",
  "chatwork_id": "tarochatworkid",
  "organization_id": 101,
  "organization_name": "Hello Company",
  "department": "Marketing",
  "avatar_image_url": "https://example.com/abc.png"
}', true);

        return [
            [$data]
        ];
    }
}
