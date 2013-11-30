<?php

namespace Chatwork\Api;

/**
 * Class My
 *
 * @package Chatwork\Api
 * @see http://developer.chatwork.com/ja/endpoint_my.html
 */
class My extends ApiAbstract
{
    /**
     * ステータス表示
     * @return mixed
     */
    public function status()
    {
        return $this->get('my/status');
    }

    /**
     * 自分のタスク一覧を取得する
     * @param $options
     *
     * @return mixed
     */
    public function tasks(array $options = array())
    {
        return $this->get('my/tasks',$options);
    }
}