<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/11/30
 * Time: 23:53
 */

namespace Chatwork\Tests\Api;

use Chatwork\Tests\ApiTestCase;
use Chatwork\Client;
use Chatwork\Api\Rooms;

class RoomsTest extends ApiTestCase
{
    /**
     * @test
     */
    public function 自分のチャット一覧の取得()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('rooms'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Rooms($client))->show();
    }
} 