<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/12/01
 * Time: 21:00
 */

namespace Chatwork\Tests\HttpClient;

use Chatwork\HttpClient\HttpClient;
use Chatwork\Tests\ApiTestCase;

class HttpClientTest extends ApiTestCase
{

    /**
     * @test
     */
    public function コンストラクタ時のオプションが正しくセットされるかを調べる()
    {
        $httpClient = new TestHttpClient([
                'timeout' => 33
            ],
             $this->getBrowserMock()
        );
        $this->assertEquals(33, $httpClient->getOption('timeout'));
    }

    /**
     * @test
     */
    public function ヘッダーをセットできているかチェックする()
    {
        $httpClient = new TestHttpClient([
                'timeout' => 33
            ],
            $this->getBrowserMock()
        );
        $expect = [
            'a'  => 'b',
            'c' => 'd'
        ];
        $httpClient->setHeaders($expect);
        $actual =  $httpClient->getHeaders();

        $actual = $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    public function GETリクエストを送る()
    {
        $path       = '/some/path';
        $parameters = ['a' => 'b'];
        $headers    = ['c' => 'd'];

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(['base_url' => 'http://www.example.com'], $client);
        $httpClient->get($path, $parameters, $headers);
    }

    /**
     * @test
     */
    public function POSTリクエストを送る()
    {
        $path       = '/some/path';
        $body       = ['a' => 'b'];
        $headers    = ['c' => 'd'];

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(['base_url' => 'http://www.example.com'], $client);
        $httpClient->post($path, $body, $headers);
    }

    /**
     * @test
     */
    public function PUTリクエストを送る()
    {
        $path       = '/some/path';
        $headers    = ['c' => 'd'];

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(['base_url' => 'http://www.example.com'], $client);
        $httpClient->put($path, $headers);
    }

    /**
     * @test
     */
    public function DELETEリクエストを送る()
    {
        $path       = '/some/path';
        $headers    = ['c' => 'd'];

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(['base_url' => 'http://www.example.com'], $client);
        $httpClient->delete($path, $headers);
    }

    /**
     * @test
     */
    public function HTTPリクエストを送る()
    {
        $path       = '/some/path';
        $parametars = ['a' => 'b'];
        $headers    = ['c' => 'd'];

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(['base_url' => 'http://www.example.com'], $client);
        $httpClient->request($path, $parametars, "GET",$headers);
    }

    /**
     * @test
     * @expectedException \Chatwork\Exception\OutOfBoundsException
     */
    public function リクエストを送る際にBASEURLを設定してない場合はエラーになる()
    {
        $path       = '/some/path';
        $parametars = ['a' => 'b'];
        $headers    = ['c' => 'd'];

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient([], $client);
        $httpClient->request($path, $parametars, "GET",$headers);
    }



    /**
     * ブラウザのモックを作成
     * @param array $methods
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getBrowserMock(array $methods = [])
    {
        $mock = $this->getMockBuilder('Buzz\Client\Curl')
          ->setMethods([
            'send',
            'createRequest',
            'setTimeout'
          ])
          ->disableOriginalConstructor()
          ->getMock();

        $mock->expects($this->any())
            ->method('createRequest')
            ->will($this->returnValue($this->getMock('Chatwork\HttpClient\Message\Request', array(), array('GET', 'some'))));

        return $mock;
    }

}

/**
 * Class TestHttpClient
 *
 * @package Chatwork\Tests\HttpClient
 */
class TestHttpClient extends HttpClient
{
    public function getOption($name, $default = null)
    {
        return isset($this->options[$name]) ? $this->options[$name] : $default;
    }

    public function request($path, array $parameters = [], $httpMethod = 'GET', array $headers = [])
    {
        $request = $this->client->createRequest($httpMethod, $path);
        $response = $this->createResponse();
        return $this->client->send($request, $response);
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
