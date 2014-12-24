<?php
namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Entity\Factory\MemberFactory;
use Polidog\Chatwork\Entity\Factory\UserFactory;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;

use Phake;

class MembersTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function メンバー一覧を取得する()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $userFactory = Phake::mock(MemberFactory::class);
        $response = Phake::mock(ResponseInterface::class);
        
        Phake::when($httpClient)->get(['rooms/{roomId}/members',['roomId' => 1]])->thenReturn($response);
        Phake::when($response)->json()->thenReturn([]);
        
        $members = new Members(1, $httpClient, $userFactory);
        $members->show();
        
        Phake::verify($httpClient,Phake::times(1))->get(['rooms/{roomId}/members',['roomId' => 1]]);
        Phake::verify($userFactory,Phake::times(1))->collection($this->isType('array'));
        Phake::verify($response,Phake::times(1))->json();
    }
    
}