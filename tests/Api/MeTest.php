<?php
namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Entity\Factory\UserFactory;
use Polidog\Chatwork\Entity\User;

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
        $factory = Phake::mock(UserFactory::class);
        
        Phake::when($httpClient)->get('me')->thenReturn($response);
        Phake::when($response)->json()->thenReturn([]);
        Phake::when($factory)->create([])->thenReturn(new User());
        
        $me = new Me($httpClient, $factory);
        $me->show();
        
        Phake::verify($httpClient, Phake::times(1))->get('me');
        Phake::verify($response, Phake::times(1))->json();
        Phake::verify($factory, Phake::times(1))->create([]);
    }
}