<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Api\My\Status;
use Polidog\Chatwork\Api\My\Tasks;
use Polidog\Chatwork\Client\ClientInterface;
use Prophecy\PhpUnit\ProphecyTrait;

class MyTest extends TestCase
{
    use ProphecyTrait;

    public function testNewMyInstance(): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $my = new My($client->reveal());

        $this->assertInstanceOf(Status::class, $my->status());
        $this->assertInstanceOf(Tasks::class, $my->tasks());
    }
}
