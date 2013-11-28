<?php

namespace Chatwork\Api\Rooms;

use Chatwork\Api\ApiAbstract;
use Chatwork\Client;

/**
 * Class Members
 *
 * @package Chatwork\Api\Rooms
 */
class Members extends ApiAbstract
{

    protected  $roomId;

    /**
     * @param Client $client
     * @param $roomId
     */
    public function __construct(Client $client, $roomId) {
        $this->client = $client;
        $this->roomId = $roomId;
    }

    /**
     * チャットのメンバー一覧を取得
     * @param int $id
     *
     * @return mixed
     */
    public function show() {
        return $this->get('rooms/'.$this->roomId.'/members');
    }

    /**
     * チャットのメンバーを一括変更
     * @param $id
     * @param $members_admin_ids
     * @param $options
     *
     * @return mixed
     */
    public function update($members_admin_ids, $options) {
        $options['members_admin_ids'] = $members_admin_ids;
        return $this->put('rooms/'.$this->roomId.'/members',$options);
    }

}