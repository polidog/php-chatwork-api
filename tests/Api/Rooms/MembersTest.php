<?php
namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\MemberFactory;
use Polidog\Chatwork\Entity\Member;
use Polidog\Chatwork\Entity\User;

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

    /**
     * @test
     */
    public function メンバーの更新をする()
    {
        $memberList = new EntityCollection();
        
        $member1 = new Member();
        $member1->role = 'admin';
        $member1->user = new User();
        $member1->user->accountId = 1;
        $memberList->add($member1);
        
        $member11 = new Member();
        $member11->role = 'admin';
        $member11->user = new User();
        $member11->user->accountId = 11;
        $memberList->add($member11);

        
        $member2 = new Member();
        $member2->role = 'member';
        $member2->user = new User();
        $member2->user->accountId = 2;
        $memberList->add($member2);

        $member22 = new Member();
        $member22->role = 'member';
        $member22->user = new User();
        $member22->user->accountId = 22;
        $memberList->add($member22);
        
        $member3 = new Member();
        $member3->role = 'readonly';
        $member3->user = new User();
        $member3->user->accountId = 3;
        $memberList->add($member3);

        $member33 = new Member();
        $member33->role = 'readonly';
        $member33->user = new User();
        $member33->user->accountId = 33;
        $memberList->add($member33);
        
        $httpClient = Phake::mock(ClientInterface::class);
        Phake::when($httpClient)->put(['rooms/{roomId}/members/',['roomId' => 1]], $this->isType('array'))
            ->thenReturn([
                'admin' => [1,11],
                'member' => [2,22],
                'readonly' => [3,33]
            ]);
        
        $members = new Members(1, $httpClient);
        $members->update($memberList);
        
        Phake::verify($httpClient,Phake::times(1))
            ->put(['rooms/{roomId}/members',['roomId' => 1]], [
                'body' => [
                    'members_admin_ids' => '1,11',
                    'members_member_ids' => '2,22',
                    'members_readonly_ids' => '3,33'
                ]
            ]);
    }
    
}