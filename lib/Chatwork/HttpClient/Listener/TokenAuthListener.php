<?php

namespace Chatwork\HttpClient\Listener;

use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;

use Buzz\Listener\ListenerInterface;

/**
 * Class TokenAuthListener
 *
 * @package Chatwork\HttpClient\Listener
 */
class TokenAuthListener implements ListenerInterface
{

    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function preSend(RequestInterface $request)
    {
        $request->addHeader('X-ChatWorkToken: '.$this->token);
    }

    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }
}