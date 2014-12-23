<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 4:40
 */

namespace Api;


use Polidog\Chatwork\Api\Me;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\ClientInterface;
use Phake;


class MeTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function callApi()
    {

        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);
        Phake::when($httpClient)->get('me')->thenReturn($response);
        Phake::when($response)->json()->thenReturn([]);
        
        $me = new Me($httpClient);
        $me->show();
        
        Phake::verify($httpClient, Phake::times(1))->get('me');
        Phake::verify($response, Phake::times(1))->json();
    }
}