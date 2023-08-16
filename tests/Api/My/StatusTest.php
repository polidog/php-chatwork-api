<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\My;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Factory\StatusFactory;

class StatusTest extends TestCase
{
    /**
     * @dataProvider providerResponseData
     */
    public function testShow($apiResult): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->get('my/status')
            ->willReturn($apiResult);

        $factory = new StatusFactory();

        $status = new Status($client->reveal(), $factory);
        $entity = $status->show();

        $this->assertInstanceOf(\Polidog\Chatwork\Entity\Status::class, $entity);
    }

    public function providerResponseData()
    {
        $data = json_decode('{
          "unread_room_num": 2,
          "mention_room_num": 1,
          "mytask_room_num": 3,
          "unread_num": 12,
          "mention_num": 1,
          "mytask_num": 8
        }', true);

        return [
            [$data]
        ];
    }
}
