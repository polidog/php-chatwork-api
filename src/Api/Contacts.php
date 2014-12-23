<?php
namespace Polidog\Chatwork\Api;

/**
 * Api Contacts
 * @package Polidog\Chatwork\Api
 */
class Contacts extends AbstractApi 
{
    /**
     * コンタクト一覧を取得する
     * 
     * @return array
     */
    public function show()
    {
        return $this->client->get('contacts')->json();
    }
}