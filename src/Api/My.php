<?php
namespace Polidog\Chatwork\Api;

/**
 * Api /my
 * @package Chatwork\Api
 */
class My extends AbstractApi 
{
    
    
    /**
     * ステータスを取得する
     * 
     * @return array
     */
    public function status()
    {
        return $this->client->get('my/status')->json();
    }

    /**
     * タスクを取得する
     * 
     * @param array $options
     * @return mixed
     */
    public function tasks(array $options = [])
    {
        return $this->client->get('my/tasks',['query' => $options])->json();
    }
    
}