<?php

namespace Chatwork\Api\Rooms;
use Chatwork\Api\ApiAbstract;
use Chatwork\Client;

/**
 * Class Messages
 *
 * @package Chatwork\Api\Rooms
 */
class Messages extends ApiAbstract
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
     * チャットのメッセージ一覧を取得
     * @param int $id メッセージID
     * @return mixed
     */
    public function show($id = null) {
        if (is_null($id)) {
            return $this->get('rooms/'.$this->roomId.'/messages');
        }
        return $this->get('rooms/'.$this->roomId.'/messages/'.$id);
    }

    /**
     * チャットに新しいメッセージを追加
     * @param $body
     *
     * @return mixed
     */
    public function create($body) {
        return $this->post('rooms/'.$this->roomId.'/messages',compact('body'));
    }
}