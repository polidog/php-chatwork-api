<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/12/03
 * Time: 0:40
 */

namespace Chatwork\Tests\Api;


use Chatwork\Api\ApiAbstract;
use Chatwork\Client;
use Chatwork\HttpClient\Message\Response;
use Chatwork\Tests\ApiTestCase;

class ApiAbsractTest extends ApiTestCase
{
    /**
     * @test
     * @expectedException Chatwork\Exception\NoSupportApiException
     */
    public function 存在しないメソッドをコールするとExceptionになる()
    {
        $testApi = new TestApiAbstract($this->getClient());
        $testApi->hoge();
    }


    /**
     * Chatwork Clientを取得する
     * @return Client
     */
    protected function getClient()
    {
        $response = new Response();

        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->any())
            ->method('get')
            ->will($this->returnValue($response));

        $httpClient->expects($this->any())
          ->method('post')
          ->will($this->returnValue($response));

        $httpClient->expects($this->any())
          ->method('put')
          ->will($this->returnValue($response));

        $httpClient->expects($this->any())
          ->method('delete')
          ->will($this->returnValue($response));

        $client = new Client($httpClient);
        return $client;
    }


}

class TestApiAbstract extends ApiAbstract
{

}