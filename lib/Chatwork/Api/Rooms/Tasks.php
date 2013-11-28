<?php
namespace Chatwork\Api\Rooms;

use Chatwork\Api\ApiAbstract;
use Chatwork\Client;

/**
 * Class Tasks
 *
 * @package Chatwork\Api\Rooms
 * @see http://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-tasks
 */
class Tasks extends ApiAbstract
{
    protected $roomId;

    /**
     * @param Client $client
     * @param $roomId
     */
    public function __construct(Client $client, $roomId) {
        $this->client = $client;
        $this->roomId = $roomId;
    }

    /**
     * チャットのタスク一覧を取得
     * @param $options
     *
     * @return mixed
     */
    public function show($options) {
        return $this->get('rooms/'.$this->roomId.'/tasks');
    }

    /**
     * チャットに新しいタスクを追加
     * @param $body
     * @param array $options
     *
     * @return mixed
     */
    public function create($body, array $options = array()) {
        $options['body'] = $body;
        return $this->post('rooms/'.$this->roomId.'/tasks',$options);
    }
}