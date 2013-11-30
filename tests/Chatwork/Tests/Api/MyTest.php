<?php

namespace Chatwork\Tests\Api;

use Chatwork\Tests\ApiTestCase;
use Chatwork\Client;
use Chatwork\Api\My;

/**
 * Class MyTest
 * @package Chatwork\Tests\Api
 */
class MyTest extends ApiTestCase
{
    /**
     * @test
     */
    public function ステータス表示()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('my/status'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new My($client))->status();

    }

    /**
     * @test
     */
    public function 自分のタスク一覧を取得する()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('my/tasks'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new My($client))->tasks();
    }
} 