<?php
/**
 * Created by JetBrains PhpStorm.
 * User: polidog
 * Date: 2013/11/29
 * Time: 0:21
 * To change this template use File | Settings | File Templates.
 */

namespace Chatwork\Api;


class Contacts extends ApiAbstract
{
    public function __call($method, $args)
    {
        return $this->show();
    }

    public function show()
    {
        return $this->get('contacts');
    }
}