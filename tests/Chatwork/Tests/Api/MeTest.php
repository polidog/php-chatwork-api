<?php

namespace Chatwork\Tests\Api;

use Chatwork\Api\Me;
use Chatwork\Client;
use Chatwork\Tests\ApiTestCase;

/**
 * Class MeTest
 * @package Chatwork\Tests\Api
 */
class MeTest extends ApiTestCase
{

    /**
     * @test
     */
    public function 自分自身の情報を取得()
    {
        $httpClientMock = $this->getHttpClientMock();
        $responseMock = $this->getResponseMock();

        $httpClientMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('me'))
            ->will($this->returnValue($responseMock));

        $responseMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $client = new Client($httpClientMock);
        $me = new Me($client);
        $me->show();
    }



} 