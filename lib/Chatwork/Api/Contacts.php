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

    /**
     * 自分のコンタクト一覧を取得
     * @return mixed
     */
    public function show()
    {
        return $this->get('contacts');
    }
}