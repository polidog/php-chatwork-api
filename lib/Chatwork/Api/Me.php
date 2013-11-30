<?php
namespace Chatwork\Api;

/**
 * Class Me
 *
 * @package Chatwork\Api
 */
class Me extends ApiAbstract
{

    /**
     * 自分自身の情報を取得
     * @return mixed
     */
    public function show() {
        return $this->get('me');
    }
}