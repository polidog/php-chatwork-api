<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/12/01
 * Time: 1:14
 */

namespace Chatwork\Tests\Api\Rooms;

use Chatwork\Tests\ApiTestCase;
use Chatwork\Client;
use Chatwork\Api\Rooms\Tasks;

class TasksTest extends ApiTestCase
{
    /**
     * @test
     */
    public function 指定したチャットワークのタスクを取得する()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('rooms/1/tasks/1'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Tasks($client,1))->show(1);
    }

    /**
     * @test
     */
    public function 指定したタスクの一覧を取得する()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('rooms/1/tasks'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Tasks($client,1))->collection();
    }

    /**
     * @test
     */
    public function チャットに新しいタスクを追加()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('post')
            ->with($this->equalTo('rooms/1/tasks'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Tasks($client,1))->create('登録テスト');
    }
} 