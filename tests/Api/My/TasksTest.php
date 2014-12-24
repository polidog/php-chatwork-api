<?php
namespace Polidog\Chatwork\Api\My;

use Polidog\Chatwork\Entity\Factory\TaskFactory;

use GuzzleHttp\ClientInterface;
use Phake;


class TasksTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function callShowApi()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $factory = Phake::mock(TaskFactory::class);
        
        Phake::when($httpClient)
            ->get('my/tasks',$this->isType('array'))
            ->thenReturn([]);
        
        Phake::when($factory)
            ->collection($this->isType('array'))
            ->thenReturn([]);
        
        $status = new Tasks($httpClient, $factory);
        $status->show();
        
        Phake::verify($httpClient,Phake::times(1))->get('my/tasks', $this->isType('array'));
        Phake::verify($factory, Phake::times(1))->collection($this->isType('array'));
        
    }
}