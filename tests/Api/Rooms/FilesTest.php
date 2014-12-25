<?php
namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\FactoryInterface;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Phake;

class FilesTest extends \PHPUnit_Framework_TestCase 
{
    
    private $httpClient;
    private $response;
    private $factory;
    
    public function setUp()
    {
        $this->httpClient = Phake::mock(ClientInterface::class);
        $this->response = Phake::mock(ResponseInterface::class);
        $this->factory = Phake::mock(FactoryInterface::class);
        
        Phake::when($this->response)
            ->json()
            ->thenReturn([]);
    }
    
    /**
     * @test
     */
    public function ファイル一覧を取得する()
    {
        Phake::when($this->httpClient)
            ->get($this->isType('array'), $this->isType('array'))
            ->thenReturn($this->response);
        
        Phake::when($this->factory)
            ->collection($this->isType('array'))
            ->thenReturn(new EntityCollection());
        
        $files = new Files(1, $this->httpClient, $this->factory);
        $files->show();
        
        Phake::verify($this->httpClient,Phake::times(1))
            ->get(
                ['rooms/{roomId}/files',['roomId' => 1]],
                [
                    'query' => [
                        'account_id' => null
                    ]
                ]
            );
        
        Phake::verify($this->response,Phake::times(1))
            ->json();
        
        Phake::verify($this->factory,Phake::times(1))
            ->collection($this->isType('array'));
    }

    /**
     * @test
     */
    public function 指定したIDのファイルの情報を取得する()
    {
        Phake::when($this->httpClient)
            ->get($this->isType('array'))
            ->thenReturn($this->response);

        Phake::when($this->factory)
            ->entity($this->isType('array'))
            ->thenReturn(new EntityCollection());

        $files = new Files(1, $this->httpClient, $this->factory);
        $files->detail(123456);

        Phake::verify($this->httpClient,Phake::times(1))
            ->get(
                ['rooms/{roomId}/files/{id}',['roomId' => 1, 'id' => 123456]]
            );

        Phake::verify($this->response,Phake::times(1))
            ->json();

        Phake::verify($this->factory,Phake::times(1))
            ->entity($this->isType('array'));        
    }
}