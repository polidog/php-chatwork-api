<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/11/30
 * Time: 23:45
 */

namespace Chatwork\Tests\Api;

use Chatwork\Tests\ApiTestCase;

use Chatwork\Client;
use Chatwork\Api\Contacts;

class ContactsTest extends ApiTestCase
{

    /**
     * @test
     */
    public function 自分のコンタクト一覧を取得()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('contacts'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        (new Contacts($client))->show();
    }
} 