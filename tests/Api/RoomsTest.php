<?php
namespace Polidog\Chatwork\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Phake;
use Polidog\Chatwork\Entity\Factory\RoomFactory;
use Polidog\Chatwork\Entity\Room;

/**
 * Class RoomsTest
 * @package Polidog\Chatwork\Api
 */
class RoomsTest extends \PHPUnit_Framework_TestCase
{
    
    private $httpClient;
    private $response;
    private $factory;
    
    public function setUp()
    {
        $this->httpClient = Phake::mock(ClientInterface::class);
        $this->response = Phake::mock(ResponseInterface::class);
        $this->factory = Phake::mock(RoomFactory::class);

        Phake::when($this->response)->json()->thenReturn([]);
    }

    /**
     * @test
     */
    public function callApiShowChatRoom()
    {
        Phake::when($this->httpClient)->get('rooms')->thenReturn($this->response);
        Phake::when($this->factory)->collection($this->isType('array'))->thenReturn([]);
        $rooms = new Rooms($this->httpClient, $this->factory);
        $rooms->show();
        
        Phake::verify($this->httpClient,Phake::times(1))->get('rooms');
        Phake::verify($this->response,Phake::times(1))->json();
        Phake::verify($this->factory, Phake::times(1))->collection($this->isType('array'));
        
    }
    
    
    /**
     * @test
     */
    public function callApiCreateChatRoom()
    {
        $room = Phake::mock(Room::class);
        $roomFactory = Phake::mock(RoomFactory::class);
        
        Phake::when($this->httpClient)->post('rooms', $this->isType('array'))->thenReturn($this->response);
        Phake::when($this->response)->json()->thenReturn([
            "room_id" => 1
        ]);
        
        Phake::when($room)->toArray()->thenReturn([
            'members_admin_ids' => '1,2',
            'name' => 'test_room'
        ]);
        
     
        $rooms = new Rooms($this->httpClient, new RoomFactory());
        $result = $rooms->create($room);
        
        Phake::verify($this->httpClient, Phake::times(1))->post('rooms', $this->isType('array'));
        Phake::verify($this->response, Phake::times(1))->json();
        Phake::verify($room, Phake::times(1))->toArray();
            
        $this->assertInstanceOf(Room::class, $result);
    }

    /**
     * @test
     */
    public function callApiUpdateRoom()
    {
        $room = Phake::mock(Room::class);
        $room->roomId = 1;
        $room->name = "hoge";
        
        Phake::when($this->httpClient)
            ->put(['rooms/{id}',['id' => 1]],$this->isType('array'))
            ->thenReturn([]);
        
        Phake::when($room)
            ->toArray()
            ->thenReturn([]);
        
        $rooms = new Rooms($this->httpClient);
        $rooms->update($room);
        
        Phake::verify($this->httpClient,Phake::times(1))->put(['rooms/{id}',['id' => 1]],$this->isType('array'));
        Phake::verify($room,Phake::times(1))->toArray();
    }

    /**
     * @test
     */
    public function callApiRemove()
    {
        $room = new Room();
        $room->roomId = 1;
        
        $rooms = new Rooms($this->httpClient);
        $rooms->remove($room, Rooms::ACTION_TYPE_LEAVE);
        
        Phake::verify($this->httpClient,Phake::times(1))
            ->delete(
                ['rooms/{id}',['id' => 1]],
                ['query' =>['action_type' => Rooms::ACTION_TYPE_LEAVE]]
            );
        
    }
    
    
    
}