<?php

namespace Chatwork\Tests\Api\Rooms;

use Chatwork\Tests\ApiTestCase;

use Chatwork\Client;
use Chatwork\Api\Rooms\Files;


/**
 * Class FilesTest
 * @package Chatwork\Tests\Api\Rooms
 */
class FilesTest extends ApiTestCase
{
    /**
     * @test
     */
    public function チャットのファイル一覧を取得()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('rooms/1/files'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Files($client,1))->show();
    }
} 