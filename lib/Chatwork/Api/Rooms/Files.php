<?php

namespace Chatwork\Api\Rooms;

use Chatwork\Api\ApiAbstract;
use Chatwork\Client;

/**
 * Class Files
 *
 * @package Chatwork\Api\Rooms
 * @see http://developer.chatwork.com/ja/endpoint_rooms.html
 */
class Files extends ApiAbstract
{

    protected $roomId;

    /**
     * @param Client $client
     * @param $roomId
     */
    public function __construct(Client $client, $roomId)
    {
        $this->client = $client;
        $this->roomId = $roomId;
    }

    /**
     * チャットのファイル一覧を取得
     * @param array $options
     *
     * @return mixed
     */
    public function show($id = null,array $options = array()) {
        if (is_null($id)) {
            return $this->get('rooms/'.$this->roomId.'/files',$options);
        }
        return $this->get('rooms/'.$this->roomId.'/files/'.$id,$options);
    }


}