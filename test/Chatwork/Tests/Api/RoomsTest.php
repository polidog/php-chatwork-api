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

    /**
     * @test
     */
    public function グループチャットを新規作成()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('post')
            ->with($this->equalTo('rooms'),$this->isType('array'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Rooms($client))->create('name', '1,2,3');
    }

    /**
     * @test
     */
    public function チャットの名前アイコンをアップデート()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('put')
            ->with($this->equalTo('rooms/1'),$this->isType('array'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Rooms($client))->update(1);
    }

    /**
     * @test
     */
    public function グループチャットを退席削除する()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('delete')
            ->with($this->equalTo('rooms/1'),$this->isType('array'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Rooms($client))->remove(1,'leave');
    }

    /**
     * @test
     */
    public function メンバーオブエジェクトを取得する()
    {
        $client = new Client();
        $actual = $client->api('rooms')->members(1);
        $this->assertInstanceOf('Chatwork\Api\Rooms\Members', $actual);
    }

    /**
     * @test
     */
    public function メッセージオブジェクトを取得する()
    {
        $client = new Client();
        $actual = $client->api('rooms')->messages(1);
        $this->assertInstanceOf('Chatwork\Api\Rooms\Messages', $actual);
    }

    /**
     * @test
     */
    public function ファイルオブジェクトを取得する()
    {
        $client = new Client();
        $actual = $client->api('rooms')->files(1);
        $this->assertInstanceOf('Chatwork\Api\Rooms\Files', $actual);
    }

    /**
     * @test
     */
    public function タスクオブジェクトを取得する()
    {
        $client = new Client();
        $actual = $client->api('rooms')->tasks(1);
        $this->assertInstanceOf('Chatwork\Api\Rooms\Tasks', $actual);
    }
}