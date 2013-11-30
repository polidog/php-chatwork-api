<?php

namespace Chatwork\Api;

use Buzz\Test\Message\Message;
use Chatwork\Api\Rooms\Members;

/**
 * Class Rooms
 * @package Chatwork\Api
 * @see http://developer.chatwork.com/ja/endpoint_rooms.html
 */
class Rooms extends ApiAbstract
{
    /**
     * 自分のチャット一覧の取得
     * @param int $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        if (is_null($id)) {
            return $this->get('rooms');
        }
        return $this->get('rooms/'.$id);
    }

    /**
     * グループチャットを新規作成
     * @param $name
     * @param $members_admin_ids
     * @param array $options
     *
     * @return mixed
     */
    public function create($name, $members_admin_ids, $options = array())
    {
        $options['name'] = $name;
        $options['members_admin_ids'] = $members_admin_ids;
        return $this->post('rooms',$options);
    }

    /**
     * チャットの名前、アイコンをアップデート
     * @param $id room id
     * @param array $options
     *
     * @return mixed
     */
    public function update($id, $options = array())
    {
        return $this->put('rooms/'.$id,$options);
    }

    /**
     * グループチャットを退席/削除する
     * @param int $id room id
     * @param string $action_type
     */
    public function remove($id, $action_type)
    {
        return $this->delete('rooms/'.$id,compact('action_type'));
    }


    /**
     * メンバーオブエジェクトを取得する
     * @param int $id room id
     */
    public function members($id)
    {
        return new Rooms\Members($this->client, $id);
    }

    /**
     * メッセージオブジェクトを取得する
     * @param int $id room id
     * @return Message
     */
    public function messages($id)
    {
        return new Rooms\Messages($this->client, $id);
    }

    /**
     * ファイルオブジェクトを取得する
     * @param int $id room id
     *
     * @return Files
     */
    public function files($id)
    {
        return new Rooms\Files($this->client, $id);
    }

    /**
     * タスクオブジェクトを取得する
     * @param $id
     *
     * @return Rooms\Tasks
     */
    public function tasks($id)
    {
        return new Rooms\Tasks($this->client, $id);
    }
}