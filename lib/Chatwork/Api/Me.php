<?php
namespace Chatwork\Api;

/**
 * Class Me
 *
 * @package Chatwork\Api
 */
class Me extends ApiAbstract
{

    public function __call($method,$args) {
        return $this->show();
    }

    /**
     * @return mixed
     */
    public function show() {
        return $this->get('me');
    }
}