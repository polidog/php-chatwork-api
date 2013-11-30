<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/12/01
 * Time: 1:05
 */

namespace Chatwork\Tests\Api\Rooms;

use Chatwork\Tests\ApiTestCase;
use Chatwork\Client;
use Chatwork\Api\Rooms\Members;

class MembersTest extends ApiTestCase
{
    /**
     * @test
     */
    public function チャットのメンバー一覧を取得()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('rooms/1/members'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Members($client,1))->show();
    }

    /**
     * @test
     */
    public function チャットのメンバーを一括変更()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('put')
            ->with($this->equalTo('rooms/1/members'), $this->isType('array'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Members($client,1))->update('1,2,3');
    }
} 