<?php

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Api\My\Status;
use Polidog\Chatwork\Api\My\Tasks;
use GuzzleHttp\ClientInterface;
use Phake;

class MyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getApiObject()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $my = new My($httpClient);

        $this->assertInstanceOf(Status::class, $my->status());
        $this->assertInstanceOf(Tasks::class, $my->tasks());
    }
}
