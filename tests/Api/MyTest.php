<?php

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Api\My\Status;
use Polidog\Chatwork\Api\My\Tasks;
use Polidog\Chatwork\ClientInterface;

class MyTest extends \PHPUnit_Framework_TestCase
{
    public function testNewMyInstance()
    {
        $client = $this->prophesize(ClientInterface::class);
        $my = new My($client->reveal());

        $this->assertInstanceOf(Status::class, $my->status());
        $this->assertInstanceOf(Tasks::class, $my->tasks());
    }
}
