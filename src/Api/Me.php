<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 1:49
 */

namespace Polidog\Chatwork\Api;


class Me extends AbstractApi 
{
    /**
     * @return array
     */
    public function show()
    {
        return $this->client->get('me')->json();
    }
}