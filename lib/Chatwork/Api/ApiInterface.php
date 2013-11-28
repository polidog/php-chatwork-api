<?php
/**
 * Created by JetBrains PhpStorm.
 * User: polidog
 * Date: 2013/11/28
 * Time: 23:08
 * To change this template use File | Settings | File Templates.
 */

namespace Chatwork\Api;


interface ApiInterface
{
    public function configure();

    public function get($path, array $parameters = array(), $requestHeaders = array());

    public function post($path, array $parameters = array(), $requestHeaders = array());

    public function put($path, array $parameters = array(), $requestHeaders = array());

}