<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/12/01
 * Time: 1:10
 */

namespace Chatwork\Tests\Api\Rooms;

use Chatwork\Tests\ApiTestCase;
use Chatwork\Client;
use Chatwork\Api\Rooms\Messages;

class MessagesTest extends ApiTestCase
{
    /**
     * @test
     */
    public function チャットのメッセージ一覧を取得()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('rooms/1/messages'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Messages($client,1))->show();
    }

    /**
     * @test
     */
    public function チャットに新しいメッセージを追加()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('post')
            ->with($this->equalTo('rooms/1/messages'), $this->isType('array'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Messages($client,1))->create('hoge');
    }
} 