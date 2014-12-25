<?php
namespace Polidog\Chatwork\Api\My;

use GuzzleHttp\ClientInterface;
use Polidog\Chatwork\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\StatusFactory;

use Phake;
use Polidog\Chatwork\Entity\Status as EntityStatus;

class StatusTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function callShowApi()
    {
        $data = json_decode('{
          "unread_room_num": 2,
          "mention_room_num": 1,
          "mytask_room_num": 3,
          "unread_num": 12,
          "mention_num": 1,
          "mytask_num": 8
        }',true);
        
        $httpClient = Phake::mock(ClientInterface::class);
        $factory = Phake::mock(StatusFactory::class);
        
        Phake::when($httpClient)->get('my/status')->thenReturn($data);
        Phake::when($factory)->entity($data)->thenReturn(new EntityStatus());
        
        $status = new Status($httpClient, $factory);
        $status->show();
        
        Phake::verify($httpClient,Phake::times(1))->get($this->equalTo('my/status'));
        Phake::verify($factory, Phake::times(1))->entity($this->isType('array'));
    }
}