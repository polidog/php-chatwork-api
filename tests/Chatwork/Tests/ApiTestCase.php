<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/11/30
 * Time: 22:51
 */

namespace Chatwork\Tests;


class ApiTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * HTTPクライアントのモックを生成
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getHttpClientMock()
    {
        return $this->getMockBuilder('Chatwork\HttpClient\HttpClient')
            ->setMethods([
                'get',
                'post',
                'put',
                'delete'
            ])
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * レスポンスオブジェクトのMockを取得する
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getResponseMock()
    {
        return $this->getMockBuilder('Chatwork\HttpClient\Message\Response')
            ->setMethods([
                'getContent'
            ])
            ->disableOriginalConstructor()
            ->getMock();
    }
} 