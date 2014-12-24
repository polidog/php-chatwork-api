<?php
namespace Polidog\Chatwork\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Phake;

class MyTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @var
     */
    private $httpClient;

    /**
     * @var
     */
    private $response;
    
    public function setUp()
    {
        $this->httpClient = Phake::mock(ClientInterface::class);
        $this->response = Phake::mock(ResponseInterface::class);

        Phake::when($this->response)->json()->thenReturn([]);        
    }
    
    /**
     * @test
     */
    public function callStatusApi()
    {
        Phake::when($this->httpClient)->get('my/status')->thenReturn($this->response);
        
        $my = new My($this->httpClient);
        $my->status();
        
        Phake::verify($this->httpClient, Phake::times(1))->get('my/status');
        Phake::verify($this->response, Phake::times(1))->json();
    }

    /**
     * @test
     */
    public function callTasksApi()
    {
        Phake::when($this->httpClient)->get('my/tasks')->thenReturn($this->response);

        $my = new My($this->httpClient);
        $my->tasks();

        Phake::verify($this->httpClient, Phake::times(1))->get('my/tasks');
        Phake::verify($this->response, Phake::times(1))->json();
        
    }
}